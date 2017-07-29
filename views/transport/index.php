<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\helpers\{TransportHelper, FreightHelper};
use app\widgets\Alert;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transport-index">
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= Alert::widget() ?>
    
    <p>
        <?= Html::a('Create Transport', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return TransportHelper::getStatusOptions()[$model->status];
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', TransportHelper::getStatusOptions(), ['prompt' => '-', 'class' => 'form-control']),
            ],
            [
                'attribute' => 'freight_id',
                'value' => 'freight.name',
                'filter' => Html::activeDropDownList($searchModel, 'freight_id', FreightHelper::getFreightsOptions(), ['prompt' => '-', 'class' => 'form-control']),
            ],
            [
                'attribute' => 'truck',
                'value' => 'truck.registration_number',
            ],
            [
                'attribute' => 'start_at',
                'filter' => false,
                'format' => 'date',
            ],
            [
                'attribute' => 'duration',
                'filter' => false,
            ],
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
                'template' => '{add-truck} {remove-truck} {start} {complete} {view} {update} {delete}',
                'buttons' => [
                    'add-truck' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-log-in"></span>', $url, ['title' => 'Add truck', 'aria-label' => 'Add truck']);
                    },
                    'remove-truck' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-log-out"></span>', $url, ['data' => ['method' => 'post'], 'title' => 'Remove truck', 'aria-label' => 'Remove truck']);
                    },
                    'start' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-play-circle"></span>', $url, ['data' => ['method' => 'post'], 'title' => 'Start transporting', 'aria-label' => 'Start transporting']);
                    },
                    'complete' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-remove-circle"></span>', $url, ['data' => ['method' => 'post'], 'title' => 'Complete transporting', 'aria-label' => 'Complete transporting']);
                    },
                ],
                'visibleButtons' => [
                    'add-truck' => function ($model) {
                        return $model->status == TransportHelper::STATUS_NOT_STARTED && $model->transportTruck === null;
                    },
                    'remove-truck' => function ($model) {
                        return $model->status == TransportHelper::STATUS_NOT_STARTED && $model->transportTruck !== null;
                    },
                    'start' => function ($model) {
                        return $model->status == TransportHelper::STATUS_NOT_STARTED && $model->transportTruck !== null;
                    },
                    'complete' => function ($model) {
                        return $model->status == TransportHelper::STATUS_TRANSPORTING;
                    },
                    'update' => function ($model) {
                        return $model->status == TransportHelper::STATUS_NOT_STARTED;
                    },
                    'delete' => function ($model) {
                        return $model->status == TransportHelper::STATUS_NOT_STARTED;
                    },
                ],
            ],
        ],
    ]); ?>
</div>
