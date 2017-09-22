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
<div class="staff-index">
    <div class="row">
        <div class="col-sm-12">
            <h1><?= Html::encode($this->title) ?></h1>
            <span style="float: right;margin-top: -45px;">
                <?= Html::a('Create Staff', ['create'], ['class' => 'btn btn-success']) ?>
            </span>
        </div>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'user_name',
            [
                'attribute' => 'user_role',
                'value' => function($searchModel) {
                    return \app\models\Staff::getRoleName($searchModel->user_role);
                },
            ],
            //'user_pwd',
            [
                'attribute' => 'user_status',
                'format' => 'raw',
                'value' => function($searchModel) {
                    $statusName = \app\models\Staff::getStatusName($searchModel->user_status);
                    $displayFormat = $searchModel->user_status ? 'label-success' : 'label-danger';
                    return "<span class='label $displayFormat'>$statusName</span>";
                },
            ],
            [
                'attribute' => 'user_area',
                'value' => function($searchModel) {
                    return \app\models\Area::getAreaNameById($searchModel->user_area);
                },
            ],
            //'user_gender',
            // 'user_desc',
            // 'user_phone',
            'created_at',
            'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
