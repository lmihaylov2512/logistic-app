<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\helpers\TruckHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Truck */

$this->title = $model->registration_number;
$this->params['breadcrumbs'][] = ['label' => 'Trucks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="truck-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'driver_id' => 'driver.fullName',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return TruckHelper::getStatusOptions(true)[$model->status];
                },
            ],
            'registration_number',
            'created_at:dateTime',
            'updated_at:dateTime',
        ],
    ]) ?>

</div>
