<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SaleData */

$this->title = 'Update Sale Data: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sale Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sale-data-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
