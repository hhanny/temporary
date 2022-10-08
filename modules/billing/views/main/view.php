<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\BillingLogic;
use app\components\Formatter;
use app\models\UnitGroup;

?>
<style>
    .card-text {
        margin-bottom: 5px;
    }
</style>
<?php if ($model->regstts_id != \app\models\Registration::Active) : ?>
    <div class="row" style="margin-bottom: 5px;">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade show mb-0">
                <strong>Pasien telah checkout pada
                    tanggal <?= date('d-m-Y', strtotime($model->date_out)) . ' ' . date('H:i', strtotime($model->time_out)) . ' oleh petugas ' . $model->updatedBy->employee->person_name ?></strong>
            </div>
        </div>
    </div>
<?php endif ?>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary-gradient"><h3 class="card-title text-white"><i
                            class="fa fa-money"></i>
                    Billing Pasien : <?= $model->reg_num ?></h3></div>
            <div class="card-body">
                <h4 class="text-dark">
                    <strong><i class="fa fa-users"></i> <?= $model->mr_number . '/' . $model->patient->fullname . ' (' . $model->patient->gender_id . ')' ?>
                    </strong>
                </h4>
                <p>
                    <i class="fa fa-birthday-cake"></i> <?= $model->patient->birth_place . ', ' . date('d-m-Y', strtotime($model->patient->date_of_birth)) . ' (' . \app\components\AppLogic::Age($model->patient->date_of_birth) . ' tahun)' ?>
                </p>
                <p><i class="fa fa-address-book"></i> <?= $model->patient->fulladdress ?></p>
                <p><i class="fa fa-phone"></i> <?= $model->patient->phone ?></p>
                <p><i class="fa fa-address-card"></i> <?= $model->patient->identity_number ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-9">
                <div class="card bg-primary">
                    <div class="card-body">
                        <div class="text-muted text-white">
                            <?php
                            $inpatient = \app\models\RegistrationInpatient::getActive($rID);
                            ?>
                            <div>
                                <i class="fa fa-calculator"></i> <?= $model->rate->name ?>
                                <?php
                                if (!empty($inpatient)) {
                                    echo '<span class="ms-2"><i class="fe fe-cast"></i> ' . $inpatient->class->class_name . '</span>';
                                    echo '<span class="ms-2"><i class="fe fe-home"></i> ' . $inpatient->bed->room->room_name . '/' . $inpatient->bed->bed_num . '</span>';
                                    echo '<span class="ms-2"><i class="mdi mdi-bank"></i> ' . $model->guaranty->name . '</span>';
                                }
                                ?>
                            </div>
                            <div>
                                <span><i class="fa fa-user-md"></i> <?= $model->unit->unit_name . '/' . $model->doctor->fullname; ?></span>
                                <span class="ms-2"><i
                                            class="fa fa-clock-o"></i> <?= date('d-m-Y', strtotime($model->date_in)) . ' ' . date('H:i', strtotime($model->time_in)) ?></span>
                            </div>
                            <div>
                                <span><i class="fe fe-user-plus"></i> <?= $model->pic_name . '(' . $model->pic_phone . ')' ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-cyan img-card box-secondary-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h2 class="mb-0 number-font" id="biaya">
                                    <?php
                                    $biaya = BillingLogic::getBiaya($rID);
                                    echo Formatter::formatNumber($biaya);
                                    ?>
                                </h2>
                                <p class="text-white mb-0">
                                    A. <?= BillingLogic::instance()->getAttributeLabel('total_biaya') ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-success img-card box-success-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h2 class="mb-0 number-font" id="diskon">
                                    <?php
                                    $diskon = BillingLogic::getDiskon($rID);
                                    echo Formatter::formatNumber($diskon);
                                    ?>
                                </h2>
                                <p class="text-white mb-0">
                                    B. <?= BillingLogic::instance()->getAttributeLabel('total_diskon') ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-yellow-dark img-card box-info-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h2 class="mb-0 number-font" id="tagihan">
                                    <?php
                                    $tagihan = BillingLogic::getTagihan($rID);
                                    echo Formatter::formatNumber($tagihan);
                                    ?>
                                </h2>
                                <p class="text-white mb-0">
                                    C. <?= BillingLogic::instance()->getAttributeLabel('total_tagihan') ?> (A-B)
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary-gradient img-card box-info-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h2 class="mb-0 number-font" id="jmlbayar">
                                    <?php
                                    $jmlbayar = BillingLogic::getJmlBayar($rID);
                                    echo Formatter::formatNumber($jmlbayar);
                                    ?>
                                </h2>
                                <p class="text-white mb-0">
                                    D. <?= BillingLogic::instance()->getAttributeLabel('total_bayar') ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-secondary img-card box-secondary-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h2 class="mb-0 number-font" id="sisabayar">
                                    <?php
                                    $sisa_bayar = BillingLogic::getSisaBayar($rID);
                                    echo Formatter::formatNumber($sisa_bayar);
                                    ?>
                                </h2>
                                <p class="text-white mb-0">
                                    E. <?= BillingLogic::instance()->getAttributeLabel('sisa_bayar') ?> (C-D)
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-bottom: 5px;">
    <div class="col-md-12">
        <div class="btn-list">
            <?php
            if ($model->regstts_id == \app\models\Registration::Active) {
                echo Html::button('<i class="fe fe-log-out me-2"></i> Checkout', ['class' => 'btn btn-dark', 'onclick' => 'checkout(' . $model->registration_id . ')']);
                echo Html::button('<i class="fe fe-cast me-2"></i> Payment', ['class' => 'btn btn-danger', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#largemodal', 'onclick' => 'formPayment()']);
            }
            ?>
            <?= Html::button('<i class="fe fe-cast me-2"></i> History Payment', ['class' => 'btn btn-info', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#extralargemodal', 'onclick' => 'showPayment()', 'data-bs-backdrop' => 'static', 'data-bs-keyboard' => 'false']) ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="tabs-menu1">
                    <ul class="nav panel-tabs">
                        <?php
                        foreach ($unitgr as $item) {
                            if (in_array($item->unitgroup_id, $roles)) {
                                if (in_array($item->unitgroup_id, UnitGroup::getMustInPatient())) {
                                    if ($model->is_inpatient) {
                                        echo '<li>' . Html::a($item->vlabel, 'javascript:void(0)', ['class' => 'me-1 tab', 'onclick' => 'showForm("' . $item->unitgroup_id . '")']) . '</li>';
                                    } else {
                                        continue;
                                    }
                                } else {
                                    echo '<li>' . Html::a($item->vlabel, 'javascript:void(0)', ['class' => 'me-1 tab', 'onclick' => 'showForm("' . $item->unitgroup_id . '")']) . '</li>';
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div id="loadloader"></div>
        <div id="loadcontent"></div>
    </div>
</div>
<?php
$uShowForm = Url::toRoute(['showdetail']);
$uFormPayment = Url::to(['formpayment']);
$uShowPayment = Url::toRoute(['showpayment']);
$uCheckout = Url::toRoute(['checkout']);
$uRedirect = Url::toRoute(['rjligd']);
if ($model->is_inpatient) {
    $uRedirect = Url::toRoute(['rin']);
}
$rID = $model->registration_id;
$sJs = <<<JS
var rID = '$rID';
function showForm(dataid){
    $.ajax({
		url: '$uShowForm',
		type: 'POST',
		dataType: "html",
		data:{
            ugid:dataid,
            rid:rID
		},
		beforeSend: function() {
            $("#loadloader").html('<div class="dimmer active"><div class="lds-hourglass"></div></div>');
            $("#loadcontent").html('');
        },
        success: function(data){
            $("#loadcontent").html(data);
        },
        complete: function(){
            $("#loadloader").html('');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            var pesan = xhr.status + " " + thrownError + xhr.responseText;
            $("#loadcontent").html(' <div class="alert alert-danger alert-dismissible">' + pesan + '</div>');
        }
    });
}
var firstKey = '$firstKey';
$(document).ready(function (){
    showForm(firstKey);
});

function formPayment(){
    $("#largemodal").find('.modal-header .modal-title').html('Payment');
    $.ajax({
		url: '$uFormPayment',
		type: 'POST',
		dataType: "html",
		data:{
            rid:rID
		},
		beforeSend: function() {
            $("#loadformloader").html('<div class="dimmer active"><div class="lds-hourglass"></div></div>');
            $("#loadformcontent").html('');
        },
        success: function(data){
            $("#loadformcontent").html(data);
        },
        complete: function(){
            $("#loadformloader").html('<div class="dimmer active"><div class="lds-hourglass"></div></div>');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            var pesan = xhr.status + " " + thrownError + xhr.responseText;
            $("#loadformcontent").html(' <div class="alert alert-danger alert-dismissible">' + pesan + '</div>');
        }
    });
}
function showPayment(){
    $("#extralargemodal").find('.modal-header .modal-title').html('History Payment');
    $.ajax({
		url: '$uShowPayment',
		type: 'POST',
		dataType: "html",
		data:{
            rid:rID
		},
		beforeSend: function() {
            $("#extraloader").html('<div class="dimmer active"><div class="lds-hourglass"></div></div>');
            $("#extraloadformcontent").html('');
        },
        success: function(data){
            $("#extraloadformcontent").html(data);
        },
        complete: function(){
            $("#extraloader").html('');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            var pesan = xhr.status + " " + thrownError + xhr.responseText;
            $("#extraloadformcontent").html(' <div class="alert alert-danger alert-dismissible">' + pesan + '</div>');
        }
    });
}
function checkout(dataid){
    swal({
        title: "Apakah ada yakin melakukan Checkout?",
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
                url: '$uCheckout',
                dataType: "json",
                data: {
                    rid:dataid
                },
                success: function (data) {
                    if (data.code == 200) {
                        $('#jmlbayar').html(data.jmlbayar);
                        swal({
                            title: "Success",
                            text: data.message,
                            type: "success"
                        }, function (isConfirm) {
                            window.location = '';
                        });
                    } else if(data.code == 400){
                        $("#largemodal").modal('show');
                        $("#loadformcontent").html('<div class="alert alert-danger" role="alert">errors[0] '+ data.errType + ' '  + data.message + '</div>');
                    }
                    else {
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
}
JS;
$this->registerJs($sJs, \yii\web\View::POS_END);
?>
