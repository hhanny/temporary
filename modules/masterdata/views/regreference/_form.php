<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Hospital;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegistrationReference */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registration-reference-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hospital_id')->dropDownList(ArrayHelper::map(Hospital::getActive(), 'hospital_id', 'name')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
