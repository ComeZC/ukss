<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SaleTargetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sale-target-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'target_name') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'target_num') ?>

    <?= $form->field($model, 'target_area') ?>

    <?php // echo $form->field($model, 'target_user') ?>

    <?php // echo $form->field($model, 'target_start_time') ?>

    <?php // echo $form->field($model, 'target_end_time') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
