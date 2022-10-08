<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Patients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Patient'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'patient_id',
            'marital_status_id',
            'gender_id',
            'education_id',
            'blood_id',
            //'job_id',
            //'religion_id',
            //'subdistrict_id',
            //'ethnic_id',
            //'hospital_id',
            //'mr_number',
            //'fullname',
            //'nickname',
            //'identity_number',
            //'address:ntext',
            //'village',
            //'phone',
            //'birth_place',
            //'date_of_birth',
            //'office_address',
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
