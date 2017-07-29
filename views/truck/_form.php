<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\{DriverHelper, TruckHelper};

/* @var $this yii\web\View */
/* @var $model app\models\Truck */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="truck-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($model->isNewRecord) : ?>
        <?= $form->field($model, 'driver_id')->dropDownList(DriverHelper::getDriversOptions(), ['prompt' => '-']) ?>
    <?php endif; ?>

    <?= $form->field($model, 'status')->dropDownList(TruckHelper::getStatusOptions()) ?>

    <?= $form->field($model, 'registration_number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
