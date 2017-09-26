<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SaleTargetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sales Target';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-target-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a('Create Sales Target', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                'target_name',
                [
                    'attribute' => 'product_id',
                    'value' => function($searchModel) {
                        return \app\models\Product::getProductNameById($searchModel->product_id);
                    },
                    'filter' => \app\models\Product::getProductMap(),
                ],
                'target_num',
                [
                    'attribute' => 'target_area',
                    'value' => function($searchModel) {
                        return \app\models\Area::getAreaNameById($searchModel->target_area);
                    },
                    'filter' => \app\models\Area::getAreaDropDownList(),
                ],
                // 'target_user',
                'target_start_time',
                'target_end_time',
                // 'created_at',
                // 'updated_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
