<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Hospital;

/* @var $this yii\web\View */
/* @var $model app\models\Doctor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doctor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hospital_id')->dropDownList(ArrayHelper::map(Hospital::getActive(), 'hospital_id', 'name')) ?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'subdistrict_id')->dropDownList((isset($model->subdistrict_id) ? [$model->subdistrict_id => $model->subdistrict->getFullSubdistrict()] : null), ['prompt' => 'Select', 'class' => 'form-control select2-show-search form-select subdistrict']) ?>

    <?= $form->field($model, 'handphone')->textInput() ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

$callRegion = Url::toRoute(['/apisrv/v1/region/getlist']);
$sJs = <<<JS
    $(document).ready(function(){
       $(".subdistrict").on('click', function(){
           $('.subdistrict')[0].focus();
       }); 
       $(".subdistrict").select2({
            placeholder: "Select Region",
            ajax: {
                url: '$callRegion',
                type: 'GET',
                dataType: 'json',
                data: function (params) {
                    return {
                        key: params.term,
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
$this->registerJs($sJs);
?>
