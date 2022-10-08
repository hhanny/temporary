<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Billing;
use yii\helpers\Html;

$urlBil = Url::toRoute(['listbyug']);

?>
<style>
    .dataTables_filter {
        text-align: right !important;
    }
</style>
<?php if ($reg->regstts_id == \app\models\Registration::Active): ?>
    <?= Html::beginForm('#', 'POST', ['id' => 'formBilling', 'class' => 'needs-validation']) ?>
    <div class="card">
        <div class="card-header bg-success">
            <h3 class="card-title text-white"><i class="fa fa-file"></i> Form <?= $mug->name ?></h3>
        </div>
        <div class="card-body">
            <div class="entryData">
                <?= Html::button('<i class="fa fa-plus-circle"></i> Add Row', ['class' => 'btn btn-info btn-sm addRow', 'style' => 'margin-bottom:5px;']) ?>
                <table class="table table-bordered" id="entryData">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th width="30%"><?= Billing::instance()->getAttributeLabel('prdrate_id') ?></th>
                        <th><?= Billing::instance()->getAttributeLabel('nominal') ?></th>
                        <th><?= Billing::instance()->getAttributeLabel('volume') ?></th>
                        <th><?= Billing::instance()->getAttributeLabel('total') ?></th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td><?= Html::dropDownList('prdrate_id[]', null, null, ['class' => 'form-control prd_name select2', 'required' => true, 'prompt' => 'Select']) ?></td>
                        <td><?= Html::textInput('nominal[]', 0, ['class' => 'form-control nominal akumulasi', 'required' => true]) ?></td>
                        <td><?= Html::textInput('volume[]', 0, ['class' => 'form-control volume akumulasi', 'required' => true]) ?></td>
                        <td><?= Html::textInput('total[]', 0, ['class' => 'form-control', 'readuired' => true, 'readonly' => true]) ?></td>
                        <td><?= Html::button('<i class="fe fe-trash"></i>', ['class' => 'btn btn-icon  btn-danger rmv']) ?></td>
                    </tr>
                    </tbody>
                </table>
                <?= Html::hiddenInput('rid', $rid) ?>
                <?= Html::hiddenInput('ugid', $ugid) ?>
                <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?= Html::endForm() ?>
<?php endif ?>
<div class="card">
    <div class="card-header bg-danger-gradient">
        <h3 class="card-title text-white"><i class="fa fa-list" aria-hidden="true"></i> List Transaksi</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered cell-border compact stripe" id="billingList">
            <thead>
            <tr>
                <th>No</th>
                <th><?= Billing::instance()->getAttributeLabel('prdrate_id') ?></th>
                <th><?= Billing::instance()->getAttributeLabel('prd_name') ?></th>
                <th><?= Billing::instance()->getAttributeLabel('coa_id') ?></th>
                <th><?= Billing::instance()->getAttributeLabel('nominal') ?></th>
                <th><?= Billing::instance()->getAttributeLabel('volume') ?></th>
                <th><?= Billing::instance()->getAttributeLabel('total') ?></th>
                <th><?= Billing::instance()->getAttributeLabel('created_by') ?></th>
                <th><?= Billing::instance()->getAttributeLabel('created_time') ?></th>
                <?php
                if ($reg->regstts_id == \app\models\Registration::Active) {
                    echo '<th>Action</th>';
                }
                ?>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('#billingList').DataTable({
        "ajax": {
            "url": "<?= $urlBil ?>",
            "type": "POST",
            "data": {
                rid: "<?= $rid ?>",
                ugid: "<?= $ugid ?>"
            }
        },
        "processing": true,
        "oLanguage": {
            "sProcessing": "<div class='dimmer active'><div class='lds-hourglass'></div></div>"
        },
        "serverSide": true,
        "ordering": false,
        "pagingType": "simple_numbers",
        "language": {
            "searchPlaceholder": "Name"
        }
    });
    $('.addRow').on('click', function () {
        $('.prd_name').select2("destroy");
        tblObj = $(this).parent().find('table#entryData');
        var aClone = tblObj.find('tbody >tr:last').clone(true);
        tblObj.find('tbody > tr:last').after(aClone);
        var rowLength = tblObj.find('tbody > tr').length;
        tblObj.find('tbody tr:last td:first').html(rowLength);
        tblObj.find('tbody tr:last td:eq(2) > input').val(0);
        tblObj.find('tbody tr:last td:eq(3) > input').val(0);
        tblObj.find('tbody tr:last td:eq(4) > input').val(0);
        showProduct();
    });
    $('.akumulasi').on('change', function () {
        let trobj = $(this).parent().parent();//object tr
        let nominal = db_format(trobj.find('td:eq(2) > input').val());
        let volume = db_format(trobj.find('td:eq(3) > input').val());
        let total = nominal * volume;
        trobj.find('td:eq(2) > input').val(number_format(nominal));
        trobj.find('td:eq(4) > input').val(number_format(total));
    });
    $('.prd_name').on('change', function () {
        var prdrate_id = $(this).val();
        var tObj = $(this);
        $.ajax({
            type: "POST",
            url: '<?= Url::toRoute(['getprdratebyid']) ?>',
            dataType: 'json',
            data: {
                id: prdrate_id,
            },
            success: function (data) {
                tObj.parent().parent().find('td:eq(2) > input').val(data.result.nominal);
                tObj.parent().parent().find('td:eq(3) > input').val(1);
                tObj.parent().parent().find('td:eq(4) > input').val(data.result.nominal);
            }
        });
    });
    $('.rmv').on('click', function () {
        table_name = $(this).closest("table");
        var rowLength = table_name.find("tbody tr").length;
        if (rowLength > 1) {
            $(this).parent().parent().remove();
            var i = 1;
            table_name.find("tbody tr").each(function () {
                $(this).find("td:first").html(i);
                i++;
            });
        } else {
            table_name.find("tbody tr").each(function () {
                table_name.find('input:text').val(' ');
            });
        }
    });
    $('#formBilling').on('submit', function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var postdata = $(this).serializeArray();
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
                        url: '<?= Url::toRoute(['save']); ?>',
                        dataType: "json",
                        data: $.param(postdata),
                        beforeSend: function () {
                            $("#loadloader").html('<div class="dimmer active"><div class="lds-hourglass"></div></div>');
                            $("#loadcontent").html('');
                        },
                        success: function (data) {
                            if (data.code == 200) {
                                swal({
                                    title: "Success",
                                    text: data.message,
                                    type: "success"
                                }, function (isConfirm) {
                                    $("#biaya").html(data.biaya);
                                    $("#diskon").html(data.diskon);
                                    $("#tagihan").html(data.tagihan);
                                    $("#sisabayar").html(data.sisabayar);
                                    showForm('<?= $ugid?>');
                                });
                            } else {
                                swal(
                                    'Failed',
                                    '' + data.message + '',
                                    'error'
                                );
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            var pesan = xhr.status + " " + thrownError + xhr.responseText;
                            $("#loadcontent").html(' <div class="alert alert-danger alert-dismissible">' + pesan + '</div>');
                        }
                    });
                }
            }
        )
    });
    $(document).ready(function () {
        $(".prd_name").select2({
            placeholder: "Search Produk",
            ajax: {
                url: '<?= Url::toRoute(['showproduk'])?>',
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
    });

    function showProduct() {
        $(".prd_name").select2({
            placeholder: "Search Produk",
            ajax: {
                url: '<?= Url::toRoute(['showproduk'])?>',
                type: 'POST',
                dataType: 'json',
                data: function (params) {
                    return {
                        key: params.term,
                        ugid: '<?= $ugid?>',
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
    }

    function delBilling(id) {
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
                    url: '<?= Url::toRoute(['delete']); ?>',
                    dataType: "json",
                    data: {
                        id: id
                    },
                    beforeSend: function () {
                        $("#loadloader").html('<div class="dimmer active"><div class="lds-hourglass"></div></div>');
                        $("#loadcontent").html('');
                    },
                    success: function (data) {
                        if (data.code == 200) {
                            swal({
                                title: "Success",
                                text: data.message,
                                type: "success"
                            }, function (isConfirm) {
                                $("#biaya").html(data.biaya);
                                $("#diskon").html(data.diskon);
                                $("#tagihan").html(data.tagihan);
                                showForm('<?= $ugid?>');
                            });
                        } else {
                            swal(
                                'Failed',
                                '' + data.message + '',
                                'error'
                            );
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        $("#loadloader").html('');
                        var pesan = xhr.status + " " + thrownError + xhr.responseText;
                        $("#loadcontent").html(' <div class="alert alert-danger alert-dismissible">' + pesan + '</div>');
                    }
                });
            }
        });
    }
</script>
