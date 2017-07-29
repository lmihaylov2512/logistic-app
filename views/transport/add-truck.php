<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\TruckHelper;

/* @var $this yii\web\View */
/* @var $model app\models\TransportTruck */

$this->title = 'Add Truck to the transport';
$this->params['breadcrumbs'][] = ['label' => 'Transports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transport-add-truck">
    
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'truck_id')->dropDownList(TruckHelper::getAvailableTrucksOptions(), ['prompt' => '-']) ?>
    
    <div class="form-group">
        <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
    
</div>
