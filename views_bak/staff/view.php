<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Staff */

$this->title = $model->user_name;
$this->params['breadcrumbs'][] = ['label' => 'Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_name',
            [
                'attribute' => 'user_role',
                'value' => \app\models\Staff::getRoleName($model->user_role),
            ],
            [
                'attribute' => 'user_status',
                'value' => \app\models\Staff::getStatusName($model->user_status),
            ],
            [
                'attribute' => 'user_area',
                'value' => \app\models\Area::getAreaNameById($model->user_area),
            ],
            'user_gender',
            'user_desc',
            'user_phone',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
