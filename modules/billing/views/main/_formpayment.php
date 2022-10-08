<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\PaymentType;
use yii\db\Expression;

?>


<div class="col-lg-12 col-md-12">
    <?php $form = ActiveForm::begin([
        'action' => '#',
        'id' => 'formpayment',
        'options' => [
            'class' => 'form-horizontal needs-validation'
        ]
    ]); ?>

    <?= $form->errorSummary($model, ['id' => 'showerror']) ?>

    <div class=" row mb-4">
        <label class="col-md-3 form-label"><?= PaymentType::instance()->getAttributeLabel('paytype_id') ?></label>
        <div class="col-md-9">
            <?php
            $expression = new Expression('t.name || \'/\' ||  jt.credit_coa_code || \'/\' || jt.jrtype_name  as name');
            $paymentType = PaymentType::find()
                ->alias('t')
                ->joinWith('jtype jt')
                ->select(['t.paytype_id', $expression])
                ->where(['t.hospital_id' => Yii::$app->user->identity->hospital_id, 't.is_active' => true, 't.is_deleted' => false])
                ->orderBy('t.s_order asc')
                ->all();
            echo $form->field($model, 'paytype_id')->dropDownList(ArrayHelper::map($paymentType, 'paytype_id', 'name'), ['prompt' => 'Select', 'required' => true])->label(false);
            ?>
        </div>
    </div>

    <div class=" row mb-4">
        <label class="col-md-3 form-label"><?= PaymentType::instance()->getAttributeLabel('description') ?></label>
        <div class="col-md-9">
            <?= $form->field($model, 'description')->textInput(['required' => true, 'autocomplete' => 'off'])->label(false) ?>
            <div class="invalid-feedback">Deskripsi Harus diisi</div>
        </div>
    </div>

    <div class=" row mb-4">
        <label class="col-md-3 form-label"><?= PaymentType::instance()->getAttributeLabel('nominal') ?></label>
        <div class="col-md-9">
            <?= $form->field($model, 'nominal')->textInput(['required' => true, 'class' => 'form-control uang', 'autocomplete' => 'off'])->label(false) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-send"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-primary btn-radius']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?php
$urlSave = \yii\helpers\Url::toRoute(['savepayment']);
?>
<script>
    $('.uang').on('change', function () {
        var a = $(this).val();
        $(this).val(number_format(a));
    });
    $('form').on('submit', function (event) {
            event.preventDefault();
            event.stopImmediatePropagation();
            formdata = $(this).serializeArray();
            formdata.push({name: 'rid', value: <?= $reg->registration_id ?>});
            swal({
                title: "Apakah ada yakin melakukan pembayaran?",
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
                        url: '<?= $urlSave ?>',
                        dataType: "json",
                        data: formdata,
                        success: function (data) {
                            if (data.code == 200) {
                                $('#diskon').html(data.diskon);
                                $('#tagihan').html(data.tagihan);
                                $('#jmlbayar').html(data.jmlbayar);
                                $('#sisabayar').html(data.sisabayar);
                                swal({
                                    title: "Success",
                                    text: data.message,
                                    type: "success"
                                }, function (isConfirm) {
                                    $('#largemodal').modal('hide');
                                });
                            } else {
                                $('#showerror').css('display', 'block');
                                $("#showerror").html('<div class="alert alert-danger" role="alert">Please fix the following error. ' + data.message + '</div>');
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            var pesan = xhr.status + thrownError + xhr.responseText;
                            $("#showerror").html('<div class="alert alert-danger dark" role="alert"><i class="icofont icofont-warning-alt"></i> ' + pesan + '</div>');
                        }
                    });
                }
            })
        }
    )
</script>
