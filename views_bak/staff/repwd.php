<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Staff */

$this->title = 'Change Password: ' . $model->user_name;
?>
<!--<div class="staff-change-pwd">

    <h1><?/*= Html::encode($this->title) */?></h1>

    <form role="form">

    </form>

</div>-->

<section class="content">
    <div class="row">
        <h1 class="box-title"><?= Html::encode($this->title) ?></h1>

        <!-- form start -->
        <form role="form" action="/staff/repwd?id=<?=$model->id?>" method="post">
            <div class="box-body">
                <?php if(isset($msg)) : ?>
                <div class="alert <?php echo $msg=='Success' ? 'alert-success' : 'alert-danger';?> alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    <?=$msg;?>
                </div>
                <?php endif; ?>
                <div class="form-group required">
                    <label for="oldPwd">Old Password</label>
                    <input type="password" class="form-control" id="oldPwd" name="oldPwd" placeholder="Enter old password">
                </div>
                <div class="form-group required">
                    <label for="newPwd">New Password</label>
                    <input type="password" class="form-control" id="newPwd" name="newPwd" placeholder="Enter new Password">
                </div>
                <div class="form-group required">
                    <label for="newPwdConfirm">Confirm New Password</label>
                    <input type="password" class="form-control" id="newPwdConfirm" name="newPwdConfirm" placeholder="Confirm new Password">
                </div>
                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <!-- /.box-body -->
        </form>
    </div>
</section>
