<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Freight */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Freights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="freight-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'weight',
            'created_at:dateTime',
            'updated_at:dateTime',
        ],
    ]) ?>

</div>
