<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Subdistrict */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subdistrict-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subdistrict_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prv_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Province::find()->all(), 'prv_id', 'prv_name'),
            [
                    'prompt' => 'Pilih Propinsi',
                    'onchange' => '$.get( "' . Url::to(['listprv']) . '?id="+$(this).val(), function( data ) {
				  $( "select#district_id" ).html( data );
				});'
            ]
    ) ?>

    <?= $form->field($model, 'district_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\District::find()->all(), 'district_id', 'district_name'), ['prompt' => 'Pilih Kabupaten', 'id' => 'district_id']) ?>

    <?= $form->field($model, 'subdistrict_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
