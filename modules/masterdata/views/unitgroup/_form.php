<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UnitGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unit-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'unitgroup_id')->textInput(['maxlength' => true, 'readonly' => $readonly]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vlabel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_order')->textInput() ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
