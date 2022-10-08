<?php

use app\assets\ZanexAsset;
use yii\helpers\Html;
use yii\helpers\Url;

ZanexAsset::register($this);
$this->beginPage();
?>
    <!doctype html>
    <html lang="en" dir="ltr">
    <head>

        <!-- META DATA -->
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Zanex – Bootstrap  Admin & Dashboard Template">
        <meta name="author" content="Spruko Technologies Private Limited">
        <meta name="keywords"
              content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">

        <!-- FAVICON -->
        <link rel="shortcut icon" type="image/x-icon"
              href="<?= $this->theme->baseUrl ?>/assets/images/brand/favicon.ico"/>

        <!-- TITLE -->
        <title><?= Yii::$app->name ?></title>
        <?php $this->head() ?>
        <?php $this->registerCsrfMetaTags() ?>
        <style>
            /*-----Feather icons-----*/
            @font-face {
                font-family: "feather" !important;
                src: url("<?= $this->theme->baseUrl?>/fonts/feather/feather-webfont.eot?t=1501841394106") !important;
                /* IE9*/
                src: url("<?= $this->theme->baseUrl?>/fonts/feather/feather-webfont.eot?t=1501841394106#iefix") format("embedded-opentype"), url("<?= $this->theme->baseUrl?>/fonts/feather/feather-webfont.woff?t=1501841394106") format("woff"), url("<?= $this->theme->baseUrl?>/fonts/feather/feather-webfont.ttf?t=1501841394106") format("truetype"), url("<?= $this->theme->baseUrl?>/fonts/feather/feather-webfont.svg?t=1501841394106#feather") format("svg") !important;
                /* iOS 4.1- */
            }
        </style>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div class="modal fade" id="largemodal" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body" id="loadformcontent"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="extralargemodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="extraloader"></div>
                    <div class="modal-body" id="extraloadformcontent"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /GLOBAL-LOADER -->
    <!-- PAGE -->
    <div class="page">
        <div class="page-main">
            <!-- HEADER -->
            <div class="header hor-header">
                <div class="container">
                    <div class="d-flex">
                        <a class="animated-arrow hor-toggle horizontal-navtoggle"><span></span></a>
                        <a class="header-brand1" href="<?= Yii::$app->homeUrl ?>">
                            <img src="<?= $this->theme->baseUrl ?>/assets/images/brand/logo-3.png"
                                 class="header-brand-img desktop-logo" alt="logo">
                            <img src="<?= $this->theme->baseUrl ?>/assets/images/brand/logo.png"
                                 class="header-brand-img light-logo" alt="logo">
                        </a><!-- LOGO -->
                        <div class="d-flex order-lg-2 ms-auto header-right-icons">
                            <div class="dropdown text-center selector profile-1">
                                <a href="#" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                                    <span class=" ms-3 d-none d-lg-block ">
                                        <span class="text-dark"><?= Yii::$app->user->identity->employee->person_name ?></span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading">
                                        <div class="text-center">
                                            <i class="dropdown-icon mdi mdi-hospital-building"></i><small
                                                    class="text-muted"><?= Html::a(Yii::$app->user->identity->hospital->name, ['/masterdata/user/sethsptl', 'id' => Yii::$app->user->getId()]) ?></small>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item" href="#">
                                        <i class="dropdown-icon mdi mdi-account-outline"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="dropdown-icon  mdi mdi-settings"></i> Settings
                                    </a>
                                    <a class="dropdown-item" href="<?= Url::toRoute(['/site/logout']) ?>">
                                        <i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
                                    </a>
                                </div>
                            </div><!-- PROFILE -->
                        </div>
                    </div>
                </div>
            </div>
            <!--/Horizontal-main -->
            <div class="sticky">
                <div class="horizontal-main hor-menu clearfix">
                    <div class="horizontal-mainwrapper container clearfix">
                        <!--Nav-->
                        <nav class="horizontalMenu clearfix">
                            <ul class="horizontalMenu-list">
                                <?= $this->render('_menu') ?>
                            </ul>
                        </nav>
                        <!--Nav-->
                    </div>
                </div>
            </div>
            <!--/Horizontal-main -->
            <div class="app-content hor-content">
                <div class="container">
                    <div class="breadcrumb">
                        <div class="float-start">
                            <ul class="breadcrumb-title">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo Url::home(); ?>">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?php echo Url::to(['/' . Yii::$app->controller->module->id . '/' . Yii::$app->controller->id . '/' . Yii::$app->controller->action->id . '']); ?>">
                                        <?php echo Yii::$app->controller->module->id . ' / ' . Yii::$app->controller->id; ?>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active"><?php echo Yii::$app->controller->action->id; ?></li>
                            </ul>
                        </div>
                    </div>
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    $this->endBody();
    $varData = \yii\helpers\Json::encode([\yii::$app->request->csrfParam => \yii::$app->request->csrfToken]);
    $ajaxSetup = <<<JS
        $.ajaxSetup({ data: $varData });
        $('input').attr('autocomplete','off');
        $('.fc-datepicker').bootstrapdatepicker({
            format: "dd-mm-yyyy",
            viewMode: "date",
            autoclose: true,
            multidateSeparator: "-",
        })
JS;
    $this->registerJs($ajaxSetup);
    ?>
    </body>
    </html>
<?php $this->endPage(); ?>