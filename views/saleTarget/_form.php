<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SaleTarget */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sale-target-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'target_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'product_id')->dropDownList(\app\models\Product::getProductMap()) ?>

        <?= $form->field($model, 'target_num')->textInput() ?>

        <?= $form->field($model, 'target_area')->dropDownList(\app\models\Area::getAreaDropDownList(), ['prompt' => '-- Select area --']) ?>

        <div class="form-group field-saletarget-target_start_time required">
            <?php
            echo '<label>Target Start Time</label>';
            echo \kartik\date\DatePicker::widget([
                'model' => $model,
                'attribute' => 'target_start_time',
                'type' => \kartik\date\DatePicker::TYPE_INPUT,
                'options' => ['placeholder' => 'Select start date ...',],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ]);
            ?>
            <div class="help-block"></div>
        </div>

        <div class="form-group field-saletarget-target_end_time required">
            <?php
            echo '<label>Target End Time</label>';
            echo \kartik\date\DatePicker::widget([
                'model' => $model,
                'attribute' => 'target_end_time',
                'type' => \kartik\date\DatePicker::TYPE_INPUT,
                'options' => ['placeholder' => 'Select end date ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ]);
            ?>
            <div class="help-block"></div>
        </div>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
