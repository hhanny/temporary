<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use app\models\Hospital;
use app\models\UnitGroup;
use app\models\ChartOfAccount;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="product-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'hospital_id')->dropDownList(ArrayHelper::map(Hospital::getActive(), 'hospital_id', 'name')) ?>

        <?= $form->field($model, 'unitgroup_id')->dropDownList(ArrayHelper::map(UnitGroup::find()->all(), 'unitgroup_id', 'name'), ['prompt' => 'Select']) ?>

        <?= $form->field($model, 'coa_id')->dropDownList(null, ['class' => 'form-control select2-show-search form-select', 'id' => 'coaSearch', 'prompt' => 'Select']) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'is_active')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
$callCoa = Url::toRoute(['/apisrv/v1/coa/getlist']);
$hID = Yii::$app->user->identity->hospital_id;
$sJS = <<<JS
$(document).ready(function(){
   $("#coaSearch").select2({
        placeholder: "Select COA",
        ajax: {
            url: '$callCoa',
            type: 'GET',
            dataType: 'json',
            data: function (params) {
                return {
                    key: params.term,
                    hID: $hID,
                    page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 10) < data.total_count
                    }
                };
            }
        }
   }); 
});
JS;
$this->registerJs($sJS);
?>