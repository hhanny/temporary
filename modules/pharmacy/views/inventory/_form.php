<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\InventoryGroup;
use app\models\InventoryLargeUnit;
use app\models\InventorySmallUnit;

/* @var $this yii\web\View */
/* @var $model app\models\Inventory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventory-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'invgroup_id')->dropDownList(ArrayHelper::map(InventoryGroup::getActive(), 'invgroup_id', 'inv_group'), ['prompt' => 'Select']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'internal_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'largeunit_id')->dropDownList(ArrayHelper::map(InventoryLargeUnit::find()->active()->all(), 'largeunit_id', 'large_unit'), ['prompt' => 'Select']) ?>

    <?= $form->field($model, 'smallunit_id')->dropDownList(ArrayHelper::map(InventorySmallUnit::find()->all(), 'smallunit_id', 'small_unit'), ['prompt' => 'Select']) ?>

    <?= $form->field($model, 'current_faktor')->textInput() ?>

    <?= $form->field($model, 'suggested_faktor')->textInput() ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
