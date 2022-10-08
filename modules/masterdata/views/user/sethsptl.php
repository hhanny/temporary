<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use app\models\Hospital;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app', 'Set Hospital,  User: {name}', [
    'name' => $model->employee->person_name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body pt-2">
            <?php $form = ActiveForm::begin([
                'id' => 'user-form',
                'encodeErrorSummary' => false,
                'errorSummaryCssClass' => 'help-block'
            ]); ?>
            <?= $form->errorSummary($model, ['class' => 'alert alert-danger']) ?>
            <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
            <?= $form->field($model, 'hospital_id')->dropDownList(ArrayHelper::map(Hospital::find()->all(), 'hospital_id', 'name'), ['prompt' => 'Select']) ?>
            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-save" aria-hidden="true"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
