<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Journal;

$app = new \app\components\AppLogic();
$this->title = 'Report Cashier Income';
?>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h3>
            <div class=card-options>

            </div>
        </div>
        <div class="card-body pt-2">
            <div class="form-group m-0">
                <div class="row ">
                    <div class="col-md-3">
                        <label class="form-label"><?= Journal::instance()->getAttributeLabel('posting_date') ?></label>
                        <div class="input-group input-daterange">
                            <?= Html::textInput('tgl1', date('d-m-Y'), ['class' => 'form-control tanggal', 'id' => 'tgl1']) ?>
                            <div class="input-group-addon">to</div>
                            <?= Html::textInput('tgl2', date('d-m-Y'), ['class' => 'form-control tanggal', 'id' => 'tgl2']) ?>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label"><?= Journal::instance()->getAttributeLabel('posting_shit') ?></label>
                        <?= Html::dropDownList('shift', null, $app->shift(), ['id' => 'shift', 'class' => 'form-control', 'prompt' => 'All']) ?>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div id="cardloader"></div>
                <div id="cardcontent"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        showIncome();
    });

    $("#shift").on('change', function () {
        showIncome();
    });

    $(".tanggal").on('change', function () {
        showIncome();
    });

    function showIncome() {
        var tgl1 = $("#tgl1").val();
        var tgl2 = $("#tgl2").val();
        var shift = $("#shift").val();
        if (shift == '') {
            shift = '-1';
        }
        $.ajax({
            url: '<?= Url::toRoute(['showcshrincome']) ?>',
            type: 'POST',
            dataType: "html",
            data: {
                tgl1: tgl1,
                tgl2: tgl2,
                shift: shift
            },
            beforeSend: function () {
                $("#cardloader").html('<div class="dimmer active"><div class="lds-hourglass"></div></div>');
                $("#cardcontent").html('');
            },
            success: function (data) {
                $("#cardcontent").html(data);
            },
            complete: function () {
                $("#cardloader").html('');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var pesan = xhr.status + " " + thrownError + xhr.responseText;
                $("#cardcontent").html(' <div class="alert alert-danger alert-dismissible">' + pesan + '</div>');
            }
        });
    }
</script>