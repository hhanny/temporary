<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Journal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JournalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$title = 'Jurnal (Belum Posting)';
$url = Url::toRoute(['unposted']);
if ($isposting) {
    $url = Url::toRoute(['posted']);
    $title = 'Jurnal (Sudah Posting)';
}
$this->title = Yii::t('app', $title);
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .fc-datepicker {
        position: relative;
        z-index: 10000 !important;
    }
</style>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body pt-2">
            <?php
            if (!$isposting) {
                echo Html::button('<i class="fa fa-send"></i> Posting Selected', ['id' => 'postBtn', 'class' => 'btn btn-primary mb-4 data-table-btn', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#largemodal']);
            }
            ?>
            <table class="table table-bordered text-nowrap cell-border compact stripe" id="journallist">
                <thead>
                <tr>
                    <th>No</th>
                    <th><?= Journal::instance()->getAttributeLabel('jr_num') ?></th>
                    <th><?= Journal::instance()->getAttributeLabel('description') ?></th>
                    <th><?= Journal::instance()->getAttributeLabel('entry_date') ?></th>
                    <th><?= Journal::instance()->getAttributeLabel('total') ?></th>
                    <th><?= Journal::instance()->getAttributeLabel('is_posting') ?></th>
                    <?php if ($isposting) : ?>
                        <th><?= Journal::instance()->getAttributeLabel('user_posting') ?></th>
                        <th><?= Journal::instance()->getAttributeLabel('posting_date') ?></th>
                        <th><?= Journal::instance()->getAttributeLabel('posting_shift') ?></th>
                    <?php endif ?>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var selected = [];
        $('#journallist').DataTable({
            "ajax": {
                "url": "<?= $url ?>",
                "type": "POST"
            },
            "processing": true,
            "oLanguage": {
                "sProcessing": "<div class='dimmer active'><div class='lds-hourglass'></div></div>"
            },
            "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]],
            "pageLength": 20,
            "serverSide": true,
            "ordering": false,
            "pagingType": "simple_numbers",
            "language": {
                "searchPlaceholder": "Name"
            }
        });
        $('#journallist tbody').on('click', 'tr', function () {
            var id = this.id;
            var index = $.inArray(id, selected);
            if (index === -1) {
                selected.push(id);
            } else {
                selected.splice(index, 1);
            }
            $(this).toggleClass('selected');
            console.log(selected);
        });
        $("#postBtn").on('click', function () {
            if (selected.length == 0) {
                $("#largemodal").find('.modal-header .modal-title').html('Warning');
                $("#loadformcontent").html('<div class="alert alert-warning" role="alert"><span class="alert-inner--text">Silakan Pilih Jurnal yang akan diposting</span></div>');
            } else {
                $("#largemodal").find('.modal-header .modal-title').html('Form Posting');
                $.ajax({
                    url: '<?= Url::toRoute(['postingform']) ?>',
                    type: 'POST',
                    dataType: "html",
                    data: {rowId: selected},
                    beforeSend: function () {
                        $("#loadformloader").html('<div class="dimmer active"><div class="lds-hourglass"></div></div>');
                        $("#loadformcontent").html('');
                    },
                    success: function (data) {
                        $("#loadformcontent").html(data);
                    },
                    complete: function () {
                        $("#loadformloader").html('<div class="dimmer active"><div class="lds-hourglass"></div></div>');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        var pesan = xhr.status + " " + thrownError + xhr.responseText;
                        $("#loadformcontent").html(' <div class="alert alert-danger alert-dismissible">' + pesan + '</div>');
                    }
                });
            }
        });
    });


    function showDetail(id) {
        $.ajax({
            url: '<?= Url::toRoute(['showdetail']) ?>',
            type: 'POST',
            dataType: "html",
            data: {jrid: id},
            beforeSend: function () {
                $("#extraloader").html('<div class="dimmer active"><div class="lds-hourglass"></div></div>');
                $("#extraloadformcontent").html('');
            },
            success: function (data) {
                $("#extralargemodal").find('.modal-header .modal-title').html('Detail Journal');
                $("#extraloadformcontent").html(data);
            },
            complete: function () {
                $("#extraloader").html('');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var pesan = xhr.status + " " + thrownError + xhr.responseText;
                $("#extraloadformcontent").html(' <div class="alert alert-danger alert-dismissible">' + pesan + '</div>');
            }
        });
    }
</script>