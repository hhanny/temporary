<?php

use app\assets\ZanexAsset;
use yii\widgets\Breadcrumbs;

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
    </head>
    <body class="app sidebar-mini">
    <?php $this->beginBody() ?>
    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="<?= $this->theme->baseUrl ?>/assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!--APP-SIDEBAR-->
            <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
            <aside class="app-sidebar">
                <div class="side-header">
                    <a class="header-brand1" href="<?= Yii::$app->homeUrl ?>">
                        <img src="<?= $this->theme->baseUrl ?>/assets/images/brand/logo.png"
                             class="header-brand-img desktop-logo" alt="logo">
                        <img src="<?= $this->theme->baseUrl ?>/assets/images/brand/logo-1.png"
                             class="header-brand-img toggle-logo" alt="logo">
                        <img src="<?= $this->theme->baseUrl ?>/assets/images/brand/logo-2.png"
                             class="header-brand-img light-logo" alt="logo">
                        <img src="<?= $this->theme->baseUrl ?>/assets/images/brand/logo-3.png"
                             class="header-brand-img light-logo1" alt="logo">
                    </a><!-- LOGO -->
                </div>
                <ul class="side-menu">
                    <li><h3>Main</h3></li>
                    <?php echo $this->render('_menu') ?>
                </ul>
            </aside>
            <!--/APP-SIDEBAR-->
            <!-- Mobile Header -->
            <div class="app-header header">
                <div class="container-fluid">
                    <div class="d-flex">
                        <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="#"></a>
                        <!-- sidebar-toggle-->
                        <a class="header-brand1 d-flex d-md-none" href="index.html">
                            <img src="<?= $this->theme->baseUrl ?>/assets/images/brand/logo.png"
                                 class="header-brand-img desktop-logo" alt="logo">
                            <img src="<?= $this->theme->baseUrl ?>/assets/images/brand/logo-1.png"
                                 class="header-brand-img toggle-logo" alt="logo">
                            <img src="<?= $this->theme->baseUrl ?>/assets/images/brand/logo-2.png"
                                 class="header-brand-img light-logo" alt="logo">
                            <img src="<?= $this->theme->baseUrl ?>/assets/images/brand/logo-3.png"
                                 class="header-brand-img light-logo1" alt="logo">
                        </a><!-- LOGO -->
                        <div class="d-flex order-lg-2 ms-auto header-right-icons">
                            <div class="dropdown d-none d-md-flex">
                                <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                    <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip"
                                          title="Dark Theme"><i class="fe fe-moon"></i></span>
                                    <span class="light-layout" data-bs-placement="bottom" data-bs-toggle="tooltip"
                                          title="Light Theme"><i class="fe fe-sun"></i></span>
                                </a>
                            </div><!-- Theme-Layout -->
                            <div class="dropdown d-none d-md-flex">
                                <a class="nav-link icon full-screen-link nav-link-bg">
                                    <i class="fe fe-minimize fullscreen-button"></i>
                                </a>
                            </div><!-- FULL-SCREEN -->
                            <div class="dropdown d-none d-md-flex profile-1">
                                <a href="#" data-bs-toggle="dropdown" class="nav-link pe-2 leading-none d-flex">
										<span>
											<img src="<?= $this->theme->baseUrl ?>/assets/images/users/1.jpg"
                                                 alt="profile-user" class="avatar  profile-user brround cover-image">
										</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading">
                                        <div class="text-center">
                                            <h5 class="text-dark mb-0"><?= Yii::$app->user->identity->employee->person_name ?></h5>
                                            <small class="text-muted"><?= \app\models\User::getRoles() ?></small>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item" href="">
                                        <i class="dropdown-icon fe fe-user"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="email.html">
                                        <i class="dropdown-icon fe fe-mail"></i> Inbox
                                        <span class="badge bg-primary float-end">3</span>
                                    </a>
                                    <a class="dropdown-item" href="emailservices.html">
                                        <i class="dropdown-icon fe fe-settings"></i> Settings
                                    </a>
                                    <a class="dropdown-item" href="faq.html">
                                        <i class="dropdown-icon fe fe-alert-triangle"></i> Need help??
                                    </a>
                                    <span class="dropdown-item">
                                        <?= \yii\helpers\Html::beginForm(['/site/logout']) ?>
                                        <?= \yii\helpers\Html::submitButton('<i class="dropdown-icon fe fe-alert-circle"></i> Sign out', ['class' => 'btn-custom', 'style' => 'border:none; background: none; color: inherit; font: inherit; cursor: pointer; outline: inherit;']) ?>
                                        <?= \yii\helpers\Html::endForm() ?>
                                    </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--app-content open-->
            <div class="app-content">
                <div class="side-app">
                    <div class="page-header">
                        <?php
                        echo Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]);
                        ?>
                    </div>
                    <?= $content ?>
                </div>
            </div>
            <!-- CONTAINER END -->
        </div>
        <!-- FOOTER -->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 text-center">
                        Copyright © 2021 - <?= date('Y') ?> <span class="text-orange">Tiga Serangkai Software</span> All
                        rights reserved
                    </div>
                </div>
            </div>
        </footer>
        <!-- FOOTER END -->
    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
    <?php $this->endBody(); ?>
    <script>
        $.ajaxSetup({
            data: <?= \yii\helpers\Json::encode([
                    \yii::$app->request->csrfParam => \yii::$app->request->csrfToken,
            ]) ?>
        });
    </script>
    </body>
    </html>
<?php $this->endPage(); ?>