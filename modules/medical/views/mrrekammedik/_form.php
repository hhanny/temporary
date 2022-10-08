<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Mrrekammedik;

/* @var $this yii\web\View */
/* @var $model app\models\Mrrekammedik */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="mrrekammedik-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $dataPost=ArrayHelper::map(\app\models\Mrkasus::find()
            ->asArray()->all(), 'kasus_id', 'nama_kasus');
        echo $form->field($model, 'kasus_id')
            ->dropDownList(
                $dataPost,
                // ['kasus_id'=>'Kasus ID']
            );
    ?>

    <?php
        $dataPost=ArrayHelper::map(\app\models\Mrstatuskembali::find()
            ->asArray()->all(), 'statuskembali_id', 'nama_statuskembali');
        echo $form->field($model, 'statuskembali_id')
            ->dropDownList(
                $dataPost,
                // ['statuskembali_id'=>'Statuskembali ID']
            );
    ?>

    <?php
        $dataPost=ArrayHelper::map(\app\models\Mrstatuslengkap::find()
            ->asArray()->all(), 'statuslengkap_id', 'nama_statuslengkap');
        echo $form->field($model, 'statuslengkap_id')
            ->dropDownList(
                $dataPost,
                // ['statuslengkap_id'=>'Statuslengkap ID']
            );
    ?>

    <?php
        $dataPost=ArrayHelper::map(\app\models\Mrugdlayanan::find()
            ->asArray()->all(), 'ugdlayanan_id', 'ugd_layanan');
        echo $form->field($model, 'ugdlayanan_id')
            ->dropDownList(
                $dataPost,
                // ['ugdlayanan_id'=>'Ugdlayanan ID']
            );
    ?>

    <?php
        $dataPost=ArrayHelper::map(\app\models\Mrugdalasandirujuk::find()
            ->asArray()->all(), 'alasandirujuk_id', 'alasan_dirujuk');
        echo $form->field($model, 'alasandirujuk_id')
            ->dropDownList(
                $dataPost,
                // ['alasandirujuk_id'=>'Alasandirujuk ID']
            );
    ?>

    <?php
        $dataPost=ArrayHelper::map(\app\models\Mrdiagnosaawal::find()
            ->asArray()->all(), 'ugddiagnosa_id', 'tanggal_kontrol');
        echo $form->field($model, 'ugddiagnosa_id')
            ->dropDownList(
                $dataPost,
                // ['ugddiagnosa_id'=>'Ugddiagnosa ID']
            );
    ?>  

    <?= $form->field($model, 'no_reg')->textInput(['maxlength' => true]) ?>

    <div class="form-group">

    <?= Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    
    </div>

    <?php ActiveForm::end(); ?>

</div>
