<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SaleTarget */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sale Targets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-target-view box box-primary">
    <div class="box-header">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'target_name',
                [
                    'attribute' => 'product_id',
                    'value' => \app\models\Product::getProductNameById($model->product_id),
                ],
                'target_num',
                [
                    'attribute' => 'target_area',
                    'value' => \app\models\Area::getAreaNameById($model->target_area),
                ],
                /*[
                    'attribute' => 'target_user',
                    'value' => \app\models\Staff::getUserNameById($model->target_user),
                ],*/
                'target_start_time',
                'target_end_time',
                'created_at',
                'updated_at',
            ],
        ]) ?>
    </div>
</div>
