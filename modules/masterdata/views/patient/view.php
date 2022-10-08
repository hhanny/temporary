<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Patient */

$this->title = $model->patient_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="patient-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->patient_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->patient_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'patient_id',
            'marital_status_id',
            'gender_id',
            'education_id',
            'blood_id',
            'job_id',
            'religion_id',
            'subdistrict_id',
            'ethnic_id',
            'hospital_id',
            'mr_number',
            'fullname',
            'nickname',
            'identity_number',
            'address:ntext',
            'village',
            'phone',
            'birth_place',
            'date_of_birth',
            'office_address',
            'created_by',
            'created_time',
            'updated_by',
            'updated_time',
            'is_deleted:boolean',
            'deleted_by',
            'deleted_time',
        ],
    ]) ?>

</div>
