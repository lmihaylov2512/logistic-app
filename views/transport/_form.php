<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\FreightHelper;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Transport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transport-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'freight_id')->dropDownList(FreightHelper::getFreightsOptions(), ['prompt' => '-']) ?>
    
    <?= $form->field($model, 'start_at')->widget(DatePicker::className(), [
        'clientOptions' => [
            'autoclose' => true,
            'orientation' => 'bottom',
            'weekStart' => 1,
            'startDate' => 'today',
        ],
    ]) ?>
    
    <?= $form->field($model, 'duration')->textInput(['type' => 'number']) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
