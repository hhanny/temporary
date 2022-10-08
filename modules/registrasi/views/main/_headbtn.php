<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="page-header">
    <div>
        <h1 class="page-title"><?= 'Pendaftaran Pasien ' . $title ?></h1>
    </div>
    <div class="ms-auto pageheader-btn">
        <?= Html::a('<i class="fe fe-plus"></i> Daftar IGD', Url::toRoute(['gd/newreg']), ['class' => 'btn btn-danger btn-icon text-white me-2']) ?>
        <?= Html::a('<i class="fe fe-plus"></i> Daftar Rawat Jalan', Url::toRoute(['rj/newreg']), ['class' => 'btn btn-info btn-icon text-white me-2']) ?>
    </div>
</div>