<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SaleTarget */

$this->title = 'Update Sale Target: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sale Targets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sale-target-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
