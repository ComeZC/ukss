<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Area */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="area-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'area_code')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'area_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_area')->dropDownList(\app\models\Area::getAreaDropDownList($model->id), ['prompt' => '-- No parent area --']) ?>

        <?= $form->field($model, 'area_desc')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'area_address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'area_zipcode')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'area_phone')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
