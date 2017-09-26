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
class PluginAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $js = [
        //'daterangepicker/moment.min.js',
        //'daterangepicker/daterangepicker.js',
        'datatables/dataTables.bootstrap.min.js',
        //'knob/jquery.knob.js',
        'chartjs/Chart.min.js',
        'morris/morris.min.js',
        //'daterangepicker/moment.js',
        // more plugin Js here
    ];
    public $css = [
        //'daterangepicker/daterangepicker.css',
        'datatables/dataTables.bootstrap.css',
        'morris/morris.css',

        // more plugin CSS here
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}
