<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RegistrationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Registrations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registration-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Registration'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
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
            'patienrate_id',
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

    <?php Pjax::end(); ?>

</div>
