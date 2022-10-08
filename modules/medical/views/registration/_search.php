<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegistrationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registration-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'registration_id') ?>

    <?= $form->field($model, 'doctor_id') ?>

    <?= $form->field($model, 'regref_id') ?>

    <?= $form->field($model, 'guaranty_id') ?>

    <?= $form->field($model, 'rate_id') ?>

    <?php // echo $form->field($model, 'regstts_id') ?>

    <?php // echo $form->field($model, 'hospital_id') ?>

    <?php // echo $form->field($model, 'picrel_id') ?>

    <?php // echo $form->field($model, 'unit_id') ?>

    <?php // echo $form->field($model, 'regsource_id') ?>

    <?php // echo $form->field($model, 'emergency_id') ?>

    <?php // echo $form->field($model, 'reason_id') ?>

    <?php // echo $form->field($model, 'reg_num') ?>

    <?php // echo $form->field($model, 'patient_id') ?>

    <?php // echo $form->field($model, 'mr_number') ?>

    <?php // echo $form->field($model, 'date_in') ?>

    <?php // echo $form->field($model, 'date_out') ?>

    <?php // echo $form->field($model, 'time_in') ?>

    <?php // echo $form->field($model, 'time_out') ?>

    <?php // echo $form->field($model, 'is_new_patient')->checkbox() ?>

    <?php // echo $form->field($model, 'is_new_unit')->checkbox() ?>

    <?php // echo $form->field($model, 'is_inpatient')->checkbox() ?>

    <?php // echo $form->field($model, 'emergency_escort') ?>

    <?php // echo $form->field($model, 'gl_letter_num') ?>

    <?php // echo $form->field($model, 'sender_name') ?>

    <?php // echo $form->field($model, 'pic_name') ?>

    <?php // echo $form->field($model, 'pic_phone') ?>

    <?php // echo $form->field($model, 'pic_address') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <?php // echo $form->field($model, 'is_deleted')->checkbox() ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <?php // echo $form->field($model, 'deleted_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
