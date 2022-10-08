<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Education */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="education-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'education_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'edu_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 's_order')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
