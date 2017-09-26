<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SaleData */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sale Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-data-view box box-primary">
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
                [
                    'attribute' => 'user_id',
                    'value' => \app\models\Staff::getUserNameById($model->user_id),
                ],
                [
                    'attribute' => 'product_id',
                    'value' => \app\models\Product::getProductNameById($model->product_id),
                ],
                'imei1',
                'imei2',
                'created_at',
                'updated_at',
            ],
        ]) ?>
    </div>
</div>
