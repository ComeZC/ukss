<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Staff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'user_role')->dropDownList(\app\models\Staff::getRoleMap()) ?>

        <?= $form->field($model, 'user_status')->dropDownList(\app\models\Staff::getStatusMap()) ?>

        <?= $form->field($model, 'user_area')->dropDownList(\app\models\Area::getAreaDropDownList(), ['prompt' => '-- Set area later --']) ?>

        <?= $form->field($model, 'user_gender')->dropDownList([ 'male' => 'Male', 'female' => 'Female', ]) ?>

        <?= $form->field($model, 'user_desc')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'user_phone')->textInput(['maxlength' => true]) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
