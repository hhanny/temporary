<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ethnic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ethnic-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ethnic_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ethnic_name')->textInput(['maxlength' => true]) ?>

    <?= Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end(); ?>

</div>
