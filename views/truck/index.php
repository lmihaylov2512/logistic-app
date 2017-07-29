<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\helpers\{TruckHelper, DriverHelper};

/* @var $this yii\web\View */
/* @var $searchModel app\models\TruckSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trucks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="truck-index">
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a('Create Truck', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return TruckHelper::getStatusOptions(true)[$model->status];
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', TruckHelper::getStatusOptions(true), ['prompt' => '-', 'class' => 'form-control']),
            ],
            [
                'attribute' => 'driver_id',
                'value' => 'driver.fullName',
                'filter' => Html::activeDropDownList($searchModel, 'driver_id', DriverHelper::getDriversOptions(), ['prompt' => '-', 'class' => 'form-control']),
            ],
            'registration_number',
            [
                'attribute' => 'created_at',
                'filter' => false,
                'format' => 'dateTime',
            ],
            [
                'attribute' => 'updated_at',
                'filter' => false,
                'format' => 'dateTime',
            ],
            
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{view} {update}',
                'visibleButtons' => [
                    'update' => function ($model) {
                        return $model->status != TruckHelper::STATUS_USED;
                    },
                ],
            ],
        ],
    ]); ?>
</div>
