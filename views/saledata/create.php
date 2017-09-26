<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SaleData */

$this->title = 'Create Sale Data';
$this->params['breadcrumbs'][] = ['label' => 'Sale Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-data-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
