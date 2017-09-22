<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AreaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Area';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <h1><?= Html::encode($this->title) ?></h1>
            <span style="float: right;margin-top: -45px;">
                <?= Html::a('Create Area', ['create'], ['class' => 'btn btn-success']) ?>
            </span>
        </div>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            //'area_code',
            'area_name',
            [
                'attribute' => 'parent_area',
                'value' => function($searchModel) {
                    return \app\models\Area::getAreaNameById($searchModel->parent_area);
                },
            ],
            //'area_desc',
            // 'area_address',
            // 'area_zipcode',
            // 'area_phone',
            'created_at',
            'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></section>
