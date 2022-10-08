<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Mrstatuslengkap;

/* @var $this yii\web\View */
/* @var $model app\models\Mrrekammediksearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mrrekammedik-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'rekammedik_id') ?>

    <?= $form->field($model, 'jenisctev_id') ?>

    <?= $form->field($model, 'infonoso_id') ?>

    <?= $form->field($model, 'kasus_id') ?>

    <?= $form->field($model, 'statuskembali_id') ?>

    <?php // echo $form->field($model, 'tuna_kode') ?>

    <?php  //echo $form->field($model, 'statuslengkap_id') ?>

    <?php // echo $form->field($model, 'ugdlayanan_id') ?>

    <?php // echo $form->field($model, 'alasandirujuk_id') ?>

    <?php // echo $form->field($model, 'ugddiagnosa_id') ?>

    <?php // echo $form->field($model, 'no_reg') ?>

    <?php // echo $form->field($model, 'anemnesa') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

