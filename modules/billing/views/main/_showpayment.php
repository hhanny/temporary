<?php

use app\models\Payment;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<style>
    table > tbody > tr > td:eq(3) {

    }
</style>
<div class="table-responsive">
    <table class="table table-bordered cell-border compact stripe" id="listPayment">
        <thead>
        <tr>
            <th>No</th>
            <th><?= Payment::instance()->getAttributeLabel('paytype_id') ?></th>
            <th><?= Payment::instance()->getAttributeLabel('description') ?></th>
            <th><?= Payment::instance()->getAttributeLabel('nominal') ?></th>
            <th><?= Payment::instance()->getAttributeLabel('journal') ?></th>
            <th><?= Payment::instance()->getAttributeLabel('created_by') ?></th>
            <th><?= Payment::instance()->getAttributeLabel('created_time') ?></th>
            <?php
            if ($reg->regstts_id == \app\models\Registration::Active) {
                echo '<th></th>';
            }
            ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        foreach ($model as $item) {
            echo '<tr>';
            echo '<td>' . $no . '</td>';
            echo '<td>' . $item->paytype->name . '</td>';
            echo '<td>' . $item->description . '</td>';
            echo '<td style="text-align: right">' . \app\components\Formatter::formatNumber($item->nominal) . '</td>';
            echo '<td>' . $item->journal->jr_num . '</td>';
            echo '<td>' . $item->createdBy->employee->person_name . '</td>';
            echo '<td>' . date('d-m-Y H:i', strtotime($item->created_time)) . '</td>';
            if ($reg->regstts_id == \app\models\Registration::Active) {
                echo '<td>' . Html::a('<i class="fa fa-trash"></i>', 'javascript:void(0)', ['class' => 'btn btn-sm btn-icon btn-danger', 'onclick' => 'delPayment(' . $item->payment_id . ')']) . '</td>';
            }
            echo '</tr>';
            $no++;
        }
        ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function () {
        $("#listPayment").DataTable();
    });

    function delPayment(payid) {
        swal({
                title: "Apakah ada yakin?",
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
                        type: "POST",
                        url: '<?= Url::toRoute(['delpayment']); ?>',
                        dataType: "json",
                        data: {payid: payid},
                        beforeSend: function () {
                            $("#extraloader").html('<div class="dimmer active"><div class="lds-hourglass"></div></div>');
                            $("#extraloadformcontent").html('');
                        },
                        success: function (data) {
                            if (data.code == 200) {
                                swal({
                                    title: "Success",
                                    text: data.message,
                                    type: "success"
                                }, function (isConfirm) {
                                    $('#diskon').html(data.diskon);
                                    $('#tagihan').html(data.tagihan);
                                    $('#jmlbayar').html(data.jmlbayar);
                                    showPayment();
                                });
                            } else {
                                swal(
                                    'Failed',
                                    '' + data.message + '',
                                    'error'
                                );
                                $('#extralargemodal').modal('hide');
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            var pesan = xhr.status + " " + thrownError + xhr.responseText;
                            $("#extraloader").html('');
                            $("#extraloadformcontent").html(' <div class="alert alert-danger alert-dismissible">' + pesan + '</div>');
                        }
                    });
                }
            }
        )
    }
</script>