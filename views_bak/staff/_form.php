<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Staff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_role')->dropDownList(\app\models\Staff::getRoleMap()) ?>

    <?= $form->field($model, 'user_status')->dropDownList(\app\models\Staff::getStatusMap()) ?>

    <?= $form->field($model, 'user_area')->dropDownList(\app\models\Area::getAreaDropDownList(), ['prompt' => '-- Set area later --']) ?>

    <?= $form->field($model, 'user_gender')->dropDownList([ 'male' => 'Male', 'female' => 'Female', ]) ?>

    <?= $form->field($model, 'user_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
