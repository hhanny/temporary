<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Journal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="journal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hospital_id')->textInput() ?>

    <?= $form->field($model, 'registration_id')->textInput() ?>

    <?= $form->field($model, 'jrgroup_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jr_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'entry_date')->textInput() ?>

    <?= $form->field($model, 'is_posting')->checkbox() ?>

    <?= $form->field($model, 'user_posting')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'posting_date')->textInput() ?>

    <?= $form->field($model, 'posting_time')->textInput() ?>

    <?= $form->field($model, 'posting_shift')->textInput() ?>

    <?= $form->field($model, 'jtype_id')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_time')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_time')->textInput() ?>

    <?= $form->field($model, 'is_deleted')->checkbox() ?>

    <?= $form->field($model, 'deleted_by')->textInput() ?>

    <?= $form->field($model, 'deleted_time')->textInput() ?>

    <?= $form->field($model, 'payment_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
