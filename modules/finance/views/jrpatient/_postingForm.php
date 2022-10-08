<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Journal;

$applogic = new \app\components\AppLogic();
$shift = $applogic->shift();
?>

<style>
    .fc-datepicker {
        position: relative;
        z-index: 99999999999999 !important;
    }
</style>
<div class="col-lg-12 col-md-12">
    <?php $form = ActiveForm::begin([
        'action' => '#',
        'id' => 'formposting',
        'options' => [
            'class' => 'needs-validation'
        ]
    ]); ?>

    <?= $form->errorSummary($model, ['id' => 'showerror']) ?>

    <div class=" row mb-4">
        <label class="col-md-3 form-label"><?= Journal::instance()->getAttributeLabel('posting_date') ?></label>
        <div class="col-md-9">
            <?= $form->field($model, 'posting_date')->textInput(['class' => 'form-control fc-datepicker', 'required' => true, 'autocomplete' => 'off'])->label(false) ?>
        </div>
    </div>

    <div class=" row mb-4">
        <label class="col-md-3 form-label"><?= Journal::instance()->getAttributeLabel('posting_shift') ?></label>
        <div class="col-md-9">
            <?= $form->field($model, 'posting_shift')->dropDownList($shift, ['class' => 'form-control', 'required' => true])->label(false) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-send"></i> ' . Yii::t('app', 'Posting'), ['class' => 'btn btn-primary btn-radius']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<script>
    $("form").on('submit', function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        formdata = $(this).serializeArray();
        formdata.push({name: 'Journal[jrid]', value: '<?= json_encode($ids) ?>'});
        swal({
            title: "Apakah ada yakin melakukan Posting?",
            text: '',
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "No",
            confirmButtonText: "Yes",
            showLoaderOnConfirm: true,
            allowOutsideClick: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: 'POST',
                    url: '<?= \yii\helpers\Url::toRoute(['posting'])?>',
                    dataType: "json",
                    data: formdata,
                    success: function (data) {
                        if (data.code == 200) {
                            swal({
                                title: "Success",
                                text: data.message,
                                type: "success"
                            }, function (isConfirm) {
                                window.location = '<?= \yii\helpers\Url::toRoute(['unposted'])?>';
                            });
                        } else if (data.code == 400) {
                            $("#largemodal").modal('show');
                            $("#loadformcontent").html('<div class="alert alert-danger" role="alert">errors[0] ' + data.errType + ' ' + data.message + '</div>');
                        } else {
                            $("#largemodal").modal('show');
                            $("#loadformcontent").html('<div class="alert alert-danger" role="alert">errors[1] ' + data.message + '</div>');
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        var pesan = xhr.status + thrownError + xhr.responseText;
                        $("#largemodal").modal('show');
                        $("#loadformcontent").html('<div class="alert alert-danger" role="alert">Please fix the following errors[2] ' + data.message + '</div>');
                    }
                });
            }
        })
    });
</script>