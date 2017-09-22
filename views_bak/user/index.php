<?php

/* @var $this yii\web\View */

$this->title = 'User List';
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        User List
        <small>user management</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!--<div class="box-header">
                    <h3 class="box-title">Hover Data Table</h3>
                </div>-->
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>UserName</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Area</th>
                                        <th>Gender</th>
                                        <th>Desc</th>
                                        <th>Phone</th>
                                        <th>Create Time</th>
                                        <th>Update Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($model as $user) : ?>
                                        <tr>
                                            <td><?=$user->id?></td>
                                            <td><?=$user->user_name?></td>
                                            <td><?=$user->getRoleName($user->user_role)?></td>
                                            <td>
                                                <span class="label <?php echo $user->user_status ? 'label-success' : 'label-danger';?>">
                                                    <?=$user->getStatusName($user->user_status)?>
                                                </span>
                                            </td>
                                            <td><?=$user->user_area?></td>
                                            <td><?=$user->user_gender?></td>
                                            <td><?=$user->user_desc?></td>
                                            <td><?=$user->user_phone?></td>
                                            <td><?=$user->created_at?></td>
                                            <td><?=$user->updated_at?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info">Total: <?=$pagination->totalCount?> records</div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers">
                                    <?php
                                    // 显示分页
                                    echo \yii\widgets\LinkPager::widget([
                                        'pagination' => $pagination,
                                        'firstPageLabel'=>"First",
                                        'prevPageLabel'=>'Prev',
                                        'nextPageLabel'=>'Next',
                                        'lastPageLabel'=>'Last',
                                    ]);
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
</section>
<!-- /.content -->

