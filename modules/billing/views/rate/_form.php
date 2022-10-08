<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Hospital;
use app\models\ClassRoom;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $model app\models\ProductRate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-rate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hospital_id')->dropDownList(ArrayHelper::map(Hospital::getActive(), 'hospital_id', 'name')) ?>

    <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(Product::getActive(), 'product_id', 'name')) ?>

    <?= $form->field($model, 'class_id')->dropDownList(ArrayHelper::map(ClassRoom::getActive(), 'class_id', 'class_name')) ?>


    <?= $form->field($model, 'nominal')->textInput() ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
