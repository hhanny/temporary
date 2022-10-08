<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RegistrationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Diagnosa Rawat Jalan';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <div class="registration-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Registration', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'registration_id',
            'doctor_id',
            'regref_id',
            'guaranty_id',
            'rate_id',
            //'regstts_id',
            //'hospital_id',
            //'picrel_id',
            //'unit_id',
            //'regsource_id',
            //'emergency_id',
            //'reason_id',
            //'reg_num',
            //'patient_id',
            //'mr_number',
            //'date_in',
            //'date_out',
            //'time_in',
            //'time_out',
            //'is_new_patient:boolean',
            //'is_new_unit:boolean',
            //'is_inpatient:boolean',
            //'emergency_escort',
            //'gl_letter_num',
            //'sender_name',
            //'pic_name',
            //'pic_phone',
            //'pic_address',
            //'created_by',
            //'created_time',
            //'updated_by',
            //'updated_time',
            //'is_deleted:boolean',
            //'deleted_by',
            //'deleted_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div> -->

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-hospital-o" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h3>
            <div class=card-options>
                <?= Html::a('<i class="fa fa-plus-circle"> Create</i>', ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
            </div>

        </div>
        <div class="card-body pt-2">
        <?php Pjax::begin(); ?>

        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'reg_num',
            'mr_number',
            'patients.fullname',
            'patients.address',
            'date_in',
            'unit_id',
            //'registration_id',
            //'doctor_id',
            //'regref_id',
            //'guaranty_id',
            //'rate_id',
            //'regstts_id',
            //'hospital_id',
            //'picrel_id',
            //'regsource_id',
            //'emergency_id',
            //'reason_id',
            //'date_out',
            //'time_in',
            //'time_out',
            //'is_new_patient:boolean',
            //'is_new_unit:boolean',
            //'is_inpatient:boolean',
            //'emergency_escort',
            //'gl_letter_num',
            //'sender_name',
            //'pic_name',
            //'pic_phone',
            //'pic_address',
            //'created_by',
            //'created_time',
            //'updated_by',
            //'updated_time',
            //'is_deleted:boolean',
            //'deleted_by',
            //'deleted_time',
            [
                'format' => 'raw',
                'header' => 'Diagnosa',
                'value' => function ($data) {
                    return Html::a('<i class="fa fa-edit"></i> Diagnosa', \yii\helpers\Url::to(['sethsptl', 'id' => $data->registration_id]), ['class' => 'btn btn-info btn-sm']);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
