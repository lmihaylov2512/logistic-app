<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Truck */

$this->title = 'Update Truck: ' . $model->registration_number;
$this->params['breadcrumbs'][] = ['label' => 'Trucks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->registration_number, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="truck-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
