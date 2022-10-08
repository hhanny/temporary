<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Mrstatuslengkap */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mrstatuslengkap-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'statuslengkap_id')->textInput() ?>

    <?= $form->field($model, 'nama_statuslengkap')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
