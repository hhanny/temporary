<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Gender */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gender-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <?= $form->field($model, 'gender_id')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <?= Html::submitButton('<i class="fa fa-save"></i> '.Yii::t('app', 'Save'), ['class' => 'btn btn-primary mt-4 mb-0']) ?>
    <?php ActiveForm::end(); ?>
</div>
