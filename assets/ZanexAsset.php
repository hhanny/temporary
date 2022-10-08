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
class ZanexAsset extends AssetBundle
{
//    public $sourcePath = '@webroot/themes/zanex';
    public $baseUrl = '@web/themes/zanex';
    public $css = [
        //BOOTSTRAP CSS
        'assets/plugins/bootstrap/css/bootstrap.min.css',
        //STYLE CSS
        'assets/css/style.css',
        'assets/css/dark-style.css',
        'assets/css/skin-modes.css',
        //SINGLE-PAGE CSS
        'assets/plugins/single-page/css/main.css',
        //C3 CHARTS CSS
        'assets/plugins/charts-c3/c3-chart.css',
        //P-scroll bar css
        'assets/plugins/p-scroll/perfect-scrollbar.css',
        //FONT-ICONS CSS
        'assets/css/icons.css',
        //DATA TABLE CSS
        'assets/plugins/datatable/css/dataTables.bootstrap5.css',
        'assets/plugins/datatable/css/buttons.bootstrap5.min.css',
        'assets/plugins/datatable/responsive.bootstrap5.css',
        //SELECT2 CSS
        'assets/plugins/select2/select2.min.css',
        //SWEET ALERT CSS
        'assets/plugins/sweet-alert/sweetalert.css',
        // INTERNAL Bootstrap DatePicker
        'assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css',
        //SIDEBAR CSS
        'assets/plugins/sidebar/sidebar.css',
        //INTERNAL IntlTelInput css-->
        'assets/plugins/intl-tel-input-master/intlTelInput.css',
        //INTERNAL multi css
        'assets/plugins/multi/multi.min.css',
        //COLOR SKIN CSS
        'assets/colors/color1.css',
        'assets/css/custom.css',
    ];

    public $js = [
        //BOOTSTRAP JS
        'assets/plugins/bootstrap/js/popper.min.js',
        'assets/plugins/bootstrap/js/bootstrap.min.js',
        //SPARKLINE JS
        'assets/js/jquery.sparkline.min.js',
        //CHART-CIRCLE JS
        'assets/js/circle-progress.min.js',
//        //INPUT MASK JS
        'assets/plugins/input-mask/jquery.mask.min.js',
        //HORIZONTAL JS
        'assets/plugins/horizontal-menu/horizontal-menu.js',
        //STICKY JS
        'assets/js/stiky.js',
        //SIDEBAR JS
        'assets/plugins/sidebar/sidebar.js',
        //DATEPICKER JS
        'assets/plugins/date-picker/date-picker.js',
//        INTERNAL Bootstrap-Datepicker js
        'assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js',
        'assets/plugins/date-picker/jquery-ui.js',
        'assets/plugins/input-mask/jquery.maskedinput.js',
        //SELECT2 JS
        'assets/plugins/select2/select2.full.min.js',
        //FORMVALIDATION JS
        'assets/js/form-validation.js',
        //SWEET-ALERT JS
        'assets/plugins/sweet-alert/sweetalert.min.js',
        // DATA TABLE JS
        'assets/plugins/datatable/js/jquery.dataTables.min.js',
        'assets/plugins/datatable/js/dataTables.bootstrap5.js',

        //CUSTOM JS
        'assets/js/custom.js'
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $depends = [
        "yii\web\YiiAsset",
        "yii\bootstrap\BootstrapAsset",
        "yii\jui\JuiAsset",
    ];
}
