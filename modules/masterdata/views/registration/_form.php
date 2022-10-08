<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Registration */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registration-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'doctor_id')->textInput() ?>

    <?= $form->field($model, 'regref_id')->textInput() ?>

    <?= $form->field($model, 'guaranty_id')->textInput() ?>

    <?= $form->field($model, 'patienrate_id')->textInput() ?>

    <?= $form->field($model, 'regstts_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hospital_id')->textInput() ?>

    <?= $form->field($model, 'picrel_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_id')->textInput() ?>

    <?= $form->field($model, 'regsource_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emergency_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reason_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reg_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patient_id')->textInput() ?>

    <?= $form->field($model, 'mr_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_in')->textInput() ?>

    <?= $form->field($model, 'date_out')->textInput() ?>

    <?= $form->field($model, 'time_in')->textInput() ?>

    <?= $form->field($model, 'time_out')->textInput() ?>

    <?= $form->field($model, 'is_new_patient')->checkbox() ?>

    <?= $form->field($model, 'is_new_unit')->checkbox() ?>

    <?= $form->field($model, 'is_inpatient')->checkbox() ?>

    <?= $form->field($model, 'emergency_escort')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gl_letter_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sender_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pic_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pic_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pic_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_time')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
