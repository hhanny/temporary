<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\ChartOfAccount;
use app\models\JournalType;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jtype_id')->dropDownList(ArrayHelper::map(JournalType::find()->active()->all(), 'jtype_id', 'jrtype_name'), ['prompt' => 'Select']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <?= $form->field($model, 'is_billing')->checkbox() ?>

    <?= $form->field($model, 'is_discount')->checkbox() ?>

    <?= $form->field($model, 'is_receivable')->checkbox() ?>

    <?= $form->field($model, 'is_bpjskes')->checkbox() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
