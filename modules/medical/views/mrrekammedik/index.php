<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\models\Patient;
use yii\models\Mrjenisctev;


/* @var $this yii\web\View */
/* @var $searchModel app\models\Mrrekammediksearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Medical Records';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <div class="mrrekammedik-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create New Record', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    
</div> -->

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-edit" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h3>
            <div class=card-options>
                <?= Html::a('<i class="fa fa-plus-circle"> Create</i>', ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
            </div>
        </div>
        <div class="card-body pt-2">
        <?php Pjax::begin(); ?>

            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        //'dokterModel' => $dokterModel,
        
        'columns' => [
            
            ['class' => 'yii\grid\SerialColumn'],

            // [
            //     'attribute' => 'jenisctev_id',
            //     'value' => function ($model) {
            //         return $model->mrjenisctev->jenis_ctev;
            //     }
                
            // ],
            //'rekammedik_id',
            'jenisctev.jenis_ctev',
            //'infonoso.infeksi_nosokomial',
            'kasus.nama_kasus',
            //'statuskembali.nama_statuskembali',
            //'tunaKode.tuna_nama',
            'statuslengkap.nama_statuslengkap',
            //'ugdlayanan.ugd_layanan',
            //'alasandirujuk.alasan_dirujuk',
            'ugddiagnosa.tanggal_kontrol',
            'no_reg',
            'registration.patient.fullname',
            //'patients.fullname',
            //'anemnesa',
            ['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>