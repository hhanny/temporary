<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\District */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="district-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'district_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prv_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Province::find()->all(), 'prv_id', 'prv_name'), ['prompt' => 'Pilih Propinsi']) ?>

    <?= $form->field($model, 'district_name')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
