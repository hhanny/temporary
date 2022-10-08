<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Mrrekammedik */

$this->title = $model->rekammedik_id;
$this->params['breadcrumbs'][] = ['label' => 'Mrrekammediks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<!-- <div class="mrrekammedik-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->rekammedik_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->rekammedik_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

   

</div> -->



<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-edit" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h3>
            <div class="card-options">
            <?= Html::a('<i class="fa fa-pencil"></i> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->rekammedik_id], ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a('<i class="fa fa-trash"></i> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->rekammedik_id], [
                        'class' => 'btn btn-danger btn-sm ms-2',
                        'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                        ],
                ]) ?>
            </div>
        </div>
        <div class="card-body pt-2">
        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
             //'rekammedik_id',
            //'jenisctev.jenis_ctev',
            //'infonoso.infeksi_nosokomial',
            'kasus.nama_kasus',
            'statuskembali.nama_statuskembali',
            //'tunaKode.tuna_nama',
            'statuslengkap.nama_statuslengkap',
            'ugdlayanan.ugd_layanan',
            'alasandirujuk.alasan_dirujuk',
            'ugddiagnosa.tanggal_kontrol',
            'no_reg',
            //'anemnesa',
        ],
    ]) ?>
        </div>
    </div>
</div>
