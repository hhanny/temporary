<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Hospital;
use app\models\CoaCategory;

/* @var $this yii\web\View */
/* @var $model app\models\ChartOfAccount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chart-of-account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model, ['class' => 'alert alert-danger']) ?>

    <?= $form->field($model, 'hospital_id')->dropDownList(ArrayHelper::map(Hospital::getActive(), 'hospital_id', 'name')) ?>

    <?= $form->field($model, 'ccat_code')->dropDownList(ArrayHelper::map(CoaCategory::getActive(), 'ccat_code', 'ccat_name'), ['prompt' => 'Select']) ?>

    <?= $form->field($model, 'coa_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coa_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent')->textInput() ?>

    <?= $form->field($model, 'coa_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
