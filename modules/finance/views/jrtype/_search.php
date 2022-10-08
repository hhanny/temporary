<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JournalTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="journal-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'jtype_id') ?>

    <?= $form->field($model, 'hospital_id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'jrtype_name') ?>

    <?= $form->field($model, 'jrgroup_id') ?>

    <?php // echo $form->field($model, 'debet_coa_id') ?>

    <?php // echo $form->field($model, 'credit_coa_id') ?>

    <?php // echo $form->field($model, 'debet_coa_value') ?>

    <?php // echo $form->field($model, 'credit_coa_value') ?>

    <?php // echo $form->field($model, 'is_active')->checkbox() ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <?php // echo $form->field($model, 'is_deleted')->checkbox() ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <?php // echo $form->field($model, 'deleted_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
