<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseOrderType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-order-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'potype_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'po_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
