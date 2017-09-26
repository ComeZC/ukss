<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AreaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Areas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="area-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a('Create Area', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                'id',
                'area_code',
                'area_name',
                [
                    'attribute' => 'parent_area',
                    'value' => function($searchModel) {
                        return \app\models\Area::getAreaNameById($searchModel->parent_area);
                    },
                    'filter' => \app\models\Area::getAreaDropDownList(),
                ],
                //'area_desc',
                // 'area_address',
                // 'area_zipcode',
                // 'area_phone',
                [
                    'attribute' => 'created_at',
                    'value' => 'created_at',
                    'filter' => \kartik\daterange\DateRangePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'createTimeRange',
                        //'defaultPresetValueOptions' => ['class' => 'hidden'],
                        //'options' => ['class' => 'form-control date-range-picker-input'],
                        'convertFormat'=>true,
                        //'presetDropdown' => true,
                        'pluginOptions'=>[
                            //'timePicker'=>true,
                            //'timePickerIncrement'=>30,
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
