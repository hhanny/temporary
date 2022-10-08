<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Hospital;
use app\models\PatientRateGroup;


/* @var $this yii\web\View */
/* @var $model app\models\PatientRate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-rate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hospital_id')->dropDownList(ArrayHelper::map(Hospital::getActive(), 'hospital_id', 'name')) ?>

    <?= $form->field($model, 'prg_id')->dropDownList(ArrayHelper::map(PatientRateGroup::find()->all(), 'prg_id', 'name'), ['prompt' => 'Select']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
