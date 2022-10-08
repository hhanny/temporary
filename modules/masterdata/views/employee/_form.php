<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin([
        'id' => 'employee-form',
        'encodeErrorSummary' => false,
        'errorSummaryCssClass' => 'help-block'
]); ?>
<?= $form->errorSummary($model, ['class'=>'alert alert-danger']) ?>
<div class="row">
    <div class="col-lg-6 col-md-12">
        <?= $form->field($model, 'employee_id')->textInput(['maxlength' => true, 'readonly' => $readonly]) ?>
    </div>
    <div class="col-lg-6 col-md-12">
        <?= $form->field($model, 'person_name')->textInput(['maxlength' => true]) ?>
    </div>
</div>


<div class="row">
    <div class="col-lg-6 col-md-12">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-6 col-md-12">
        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-12">
        <?= $form->field($model, 'date_of_bird')->textInput(['maxlength' => true, 'class' => 'form-control fc-datepicker']) ?>
    </div>
    <div class="col-lg-6 col-md-12">
        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    </div>
</div>
<div class="form-group">
    <?= Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
