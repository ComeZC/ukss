<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HeaderjsAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $js = [
        'JQuery/jquery-2.2.3.min.js',
        'daterangepicker/moment.min.js',
        'daterangepicker/daterangepicker.js',
        'datatables/dataTables.bootstrap.min.js',
        //'daterangepicker/moment.js',
        // more plugin Js here
    ];
    public $css = [
        'daterangepicker/daterangepicker.css',
        'datatables/dataTables.bootstrap.css',
        // more plugin CSS here
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}
