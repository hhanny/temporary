<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegInpatientSource */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-inpatient-source-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'regsource_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
