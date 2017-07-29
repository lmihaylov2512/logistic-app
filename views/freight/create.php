<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Freight */

$this->title = 'Create Freight';
$this->params['breadcrumbs'][] = ['label' => 'Freights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="freight-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
