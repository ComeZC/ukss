<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                'product_name',
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
