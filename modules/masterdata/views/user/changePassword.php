<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app', 'Change Password,  User: {name}', [
        'name' => $model->employee->person_name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-graduation-cap" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body pt-2">
            <?php $form = ActiveForm::begin([
                    'id' => 'user-form',
                    'encodeErrorSummary' => false,
                    'errorSummaryCssClass' => 'help-block'
            ]); ?>
            <?= $form->errorSummary($model, ['class' => 'alert alert-danger']) ?>
            <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'checkPswd')->passwordInput(['maxlength' => true]) ?>
            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-save" aria-hidden="true"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
