<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FreightSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Freights';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="freight-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Freight', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'name',
            'weight',
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
            ],
        ],
    ]); ?>
</div>
