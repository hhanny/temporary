<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReligionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => [
                    'data-pjax' => 1
            ],
    ]); ?>
    <div class="col-sm-4 col-md-4">
        <?= $form->field($model, 'religion_id') ?>
    </div>
    <div class="col-sm-4 col-md-4">
        <?= $form->field($model, 'name') ?>
    </div>
    <div class="col-sm-4 col-md-4">
        <label class="control-label">&nbsp;</label>
        <div class="form-group">
            <div class="input-group-btn">
                <?= Html::submitButton('<i class="fa fa-search"></i> ' . Yii::t('app', 'Search'), ['class' => 'btn btn-blue']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

