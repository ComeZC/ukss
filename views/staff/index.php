<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\StaffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staff';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a('Create Staff', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                'user_name',
                [
                    'attribute' => 'user_role',
                    'value' => function($searchModel) {
                        return \app\models\Staff::getRoleName($searchModel->user_role);
                    },
                    'filter' => \app\models\Staff::getRoleMap(),
                ],
                [
                    'attribute' => 'user_status',
                    'format' => 'raw',
                    'value' => function($searchModel) {
                        $statusName = \app\models\Staff::getStatusName($searchModel->user_status);
                        $displayFormat = $searchModel->user_status ? 'label-success' : 'label-danger';
                        return "<span class='label $displayFormat'>$statusName</span>";
                    },
                    'filter' => \app\models\Staff::getStatusMap(),
                ],
                [
                    'attribute' => 'user_area',
                    'value' => function($searchModel) {
                        return \app\models\Area::getAreaNameById($searchModel->user_area);
                    },
                    'filter' => \app\models\Area::getAreaDropDownList(),
                ],
                // 'user_gender',
                // 'user_desc',
                // 'user_phone',
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
