<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="user-form">

        <?php $form = ActiveForm::begin([
                'id' => 'user-form',
                'encodeErrorSummary' => false,
                'errorSummaryCssClass' => 'help-block'
        ]); ?>

        <?= $form->errorSummary($model, ['class' => 'alert alert-danger']) ?>

        <?= $form->field($model, 'person_id')->dropDownList(null, ['id' => 'user-person_id', 'class' => 'form-control select2-show-search form-select', 'data-placeholder' => 'Choose one']) ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'checkPswd')->passwordInput(['maxlength' => true]) ?>


        <?= $form->field($model, 'is_active')->checkbox() ?>
        <div class="form-group">
            <?= Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
<?php
$url = Url::toRoute(['/apisrv/v1/employee/getlist']);
$script = <<< JS
        $('#user-person_id').select2({
            placeholder: 'Cari Karyawan',
            ajax: {
                url: "$url",
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
                },
            }
        });
        $(document).on('select2:open', () => {document.querySelector('.select2-search__field').focus();});
JS;
$this->registerJs($script);
?>