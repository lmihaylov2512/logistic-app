<?php

namespace app\controllers;

use Yii;
use app\models\{Transport, TransportSearch, TransportTruck};
use yii\web\{Controller, NotFoundHttpException};
use yii\filters\VerbFilter;
use app\helpers\TransportHelper;

/**
 * TransportController implements the CRUD actions for Transport model.
 */
class TransportController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'remove-truck' => ['POST'],
                ],
            ],
        ];
    }
    
    /**
     * Lists all Transport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transport model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transport();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Transport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * Deletes an existing Transport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        
        return $this->redirect(['index']);
    }
    
    public function actionAddTruck($id)
    {
        $model = $this->findModel($id);
        
        if ($model->status != TransportHelper::STATUS_NOT_STARTED && $model->transportTruck !== null) {
            return $this->redirect(['index']);
        }
        
        $model = new TransportTruck(['transport_id' => $model->id]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->transport_id]);
        }
        
        return $this->render('add-truck', [
            'model' => $model,
        ]);
    }
    
    public function actionRemoveTruck($id)
    {
        $model = $this->findModel($id);
        
        if ($model->status != TransportHelper::STATUS_NOT_STARTED) {
            Yii::$app->session->setFlash('warning', 'asdsadsa');
            
            return $this->redirect(['index']);
        }
        
        $model->transportTruck->delete();
        Yii::$app->session->setFlash('success', 'Successfully removed the truck');
        
        return $this->redirect(['index']);
    }
    
    public function actionStart($id)
    {
        $model = $this->findModel($id);
        
        if ($model->status != TransportHelper::STATUS_NOT_STARTED || $model->transportTruck === null) {
            return $this->redirect(['index']);
        }
    }
    
    /**
     * Finds the Transport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Transport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transport::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
