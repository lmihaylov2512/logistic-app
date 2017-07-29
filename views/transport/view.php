<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\helpers\TransportHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Transport */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transport-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return TransportHelper::getStatusOptions()[$model->status];
                },
            ],
            'freight_id' => 'freight.name',
            'truck.registration_number',
            'truck.driver.fullName',
            'start_at:date',
            'duration',
            'created_at:dateTime',
            'updated_at:dateTime',
        ],
    ]) ?>

</div>
