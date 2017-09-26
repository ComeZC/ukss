<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SaleData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sale-data-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?php echo Html::hiddenInput('SaleData[user_id]', Yii::$app->user->getIdentity()->id); ?>

        <?= $form->field($model, 'product_id')->dropDownList(\app\models\Product::getProductMap()) ?>

        <?= $form->field($model, 'imei1')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'imei2')->textInput(['maxlength' => true]) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
