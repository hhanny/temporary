<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\JournalGroup;
use yii\helpers\ArrayHelper;
use app\models\ChartOfAccount;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\JournalType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="journal-type-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]); ?>

    <?= $form->errorSummary($model, ['class' => 'alert alert-danger']) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jrtype_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jrgroup_id')->dropDownList(ArrayHelper::map(JournalGroup::find()->active()->all(), 'jrgroup_id', 'journal_group'), ['prompt' => 'Select']) ?>

    <?php
    $debet = null;
    if (isset($model->debet_coa_id)) {
        $debet = [$model->debet_coa_id => $model->debet_coa_code . '/' . $model->debet_coa_name];
    }
    $credit = null;
    if (isset($model->credit_coa_id)) {
        $credit = [$model->credit_coa_id => $model->credit_coa_code . '/' . $model->credit_coa_name];
    }
    ?>

    <?= $form->field($model, 'debet_coa_id')->dropDownList($debet, ['prompt' => 'Select', 'class' => 'form-control coa_id select2']) ?>

    <?= $form->field($model, 'credit_coa_id')->dropDownList($credit, ['prompt' => 'Select', 'class' => 'form-control coa_id select2']) ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script>
    $(document).ready(function () {
        $(".coa_id").select2({
            placeholder: "Search Produk",
            ajax: {
                url: '<?= Url::toRoute(['showcoa'])?>',
                type: 'POST',
                dataType: 'json',
                data: function (params) {
                    return {
                        key: params.term,
                        ugid: '<?= $ugid ?>',
                        class_id: '<?= $class_id?>',
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
    })
</script>