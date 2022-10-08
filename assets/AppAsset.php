<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@webroot/themes/smarthr';
    public $baseUrl = '@web/themes/smarthr';
    public $css = [
        "assets/css/bootstrap.min.css",
        "assets/css/font-awesome.min.css",
        "assets/css/line-awesome.min.css",
        "assets/css/style.css"
    ];
    public $js = [
        "assets/js/html5shiv.min.js",
        "assets/js/respond.min.js",
        "assets/js/jquery-3.5.1.min.js",
		"assets/js/select2.min.js",
        "assets/js/popper.min.js",
        "assets/js/bootstrap.min.js",
        "assets/js/jquery.slimscroll.min.js",
        "assets/js/app.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
