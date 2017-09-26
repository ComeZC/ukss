<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SaleDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sales Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-data-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a('Add Sales Data', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive">
        <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                [
                    'attribute' => 'user_id',
                    'value' => function($searchModel) {
                        return \app\models\Staff::getUserNameById($searchModel->user_id);
                    },
                ],
                [
                    'attribute' => 'product_id',
                    'value' => function($searchModel) {
                        return \app\models\Product::getProductNameById($searchModel->product_id);
                    },
                    'filter' => \app\models\Product::getProductMap(),
                ],
                'imei1',
                'imei2',
                [
                    'attribute' => 'created_at',
                    'value' => 'created_at',
                    'filter' => \kartik\daterange\DateRangePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'createTimeRange',
                        'convertFormat'=>true,
                        'pluginOptions'=>[
                            'locale'=>[
                                'format'=>'Y-m-d'
                            ]
                        ]
                    ]),
                ],
                [
                    'attribute' => 'updated_at',
                    'value' => 'updated_at',
                    'filter' => \kartik\daterange\DateRangePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'updateTimeRange',
                        'convertFormat'=>true,
                        'pluginOptions'=>[
                            'locale'=>[
                                'format'=>'Y-m-d'
                            ]
                        ]
                    ]),
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
