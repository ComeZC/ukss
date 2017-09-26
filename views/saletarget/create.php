<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SaleTarget */

$this->title = 'Create Sale Target';
$this->params['breadcrumbs'][] = ['label' => 'Sale Targets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-target-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
