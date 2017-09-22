<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Area */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="area-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'area_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'area_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_area')->dropDownList(\app\models\Area::getAreaDropDownList($model->id), ['prompt' => '-- No parent area --']) ?>

    <?= $form->field($model, 'area_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'area_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'area_zipcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'area_phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
