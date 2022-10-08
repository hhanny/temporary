<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmergencyReason */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emergency-reason-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reason_id')->textInput(['maxlength' => true, 'readonly' => $readonly]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_order')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
