<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>
<div class="page error-bg">
    <div class="page-content error-page error2">
        <div class="container text-center">
            <div class="error-template">
                <h3 class="display-2 text-dark mb-2"><?= Html::encode($this->title) ?></h3>
                <h5 class="error-details text-dark">
                    <p><?= nl2br(Html::encode($message)) ?></p>
                </h5>
                <div class="text-center">
                    <a class="btn btn-primary mt-5 mb-5" href="<?= Yii::$app->request->referrer ?>"> <i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back </a>
                </div>
            </div>
        </div>
    </div>
</div>