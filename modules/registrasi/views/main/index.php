<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Patients');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="row">
        <?= $this->render('_headbtn') ?>
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Pasien</h3>
                </div>
                <div class="card-body">
                    <?php Pjax::begin(['clientOptions' => ['method' => 'POST']]); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'mr_number',
                            'fullname',
                            ['attribute' => 'identity_number', 'filter' => false],
                            ['attribute' => 'address', 'filter' => false],
                            ['attribute' => 'date_of_birth', 'filter' => false],
                            [
                                'header' => 'Daftar Ulang',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Html::button('Rawat Jalan', ['class' => 'btn btn-sm btn-primary', 'pid' => $model->patient_id, 'url' => Url::toRoute(['rj/newreg', 'id' => $model->patient_id])]) . ' ' . Html::button('IGD', ['class' => 'btn btn-sm btn-info', 'pid' => $model->patient_id, 'url' => Url::toRoute(['gd/newreg', 'id' => $model->patient_id])]);
                                }
                            ]
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
<?php
$urlCRegActive = Url::toRoute(['/apisrv/v1/registration/check-reg-active']);
$sJs = <<<JS
    $("button").on('click', function (){
        var pid = $(this).attr('pid');
        var urlNewReg = $(this).attr('url');
        $.ajax({
            type: "POST",
            url: '$urlCRegActive',
            dataType: "json",
            data: {
                pid: pid
            },
            beforeSend: function () {
                $("#loadloader").html('<div class="dimmer active"> <div class="spinner"></div> </div>');
                $("#loadformcontent").hide();
            },
            success: function (data) {
                if (data != null) {
                    $('#loadmodal').modal('hide');
                        swal('Failed', data.message, 'error');
                } else{
                    window.location = urlNewReg;
                }
            },
            complete: function () {
                $("#loadformloader").html('');
                $("#loadformcontent").show();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var pesan = xhr.status + " " + thrownError + " " + xhr.responseText;
                $("#loadformcontent").html('<div class="alert alert-danger dark" role="alert"><i class="icofont icofont-warning-alt"></i> ' + pesan + '</div>');
            },
        });
    });
JS;
$this->registerJs($sJs, \yii\web\View::POS_END);
?>