<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MaritalStatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marital-status-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'marital_status_id')->textInput(['maxlength' => true, 'readonly' => $readonly]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
