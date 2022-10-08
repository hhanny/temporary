<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Unit;
use app\models\PatientRate;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RegistrationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', $title);
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    ['class' => 'yii\grid\SerialColumn'],
    'reg_num',
    [
        'attribute' => 'mr_number',
        'headerOptions' => [
            'style' => 'width:100px;'
        ],
        'contentOptions' => [
            'style' => 'text-align:center;'
        ]
    ],
    [
        'attribute' => 'reg_patient_name',
        'value' => function ($model) {
            return $model->patient->fullname;
        }
    ],
    [
        'attribute' => 'unit_id',
        'value' => function ($model) {
            return $model->unit->unit_name;
        },
        'filter' => ArrayHelper::map(Unit::getActive(), 'unit_id', 'unit_name')
    ],
    [
        'attribute' => 'rate_id',
        'value' => 'rate.name',
        'filter' => ArrayHelper::map(PatientRate::getActive(), 'rate_id', 'name')
    ],
    [
        'attribute' => 'doctor_id',
        'value' => function ($model) {
            return $model->doctor->fullname;
        },
        'filter' => false
    ],
    [
        'attribute' => 'date_in',
        'value' => function ($model) {
            return date('d-m-Y', strtotime($model->date_in)) . ' ' . date('H:i', strtotime($model->time_in));
        },
        'filter' => false,
        'headerOptions' => [
            'style' => 'width:150px;'
        ]
    ]
];

if ($history) {
    $arins = [
        'attribute' => 'date_out',
        'value' => function ($model) {
            return date('d-m-Y', strtotime($model->date_out)) . ' ' . date('H:i', strtotime($model->time_out));
        },
        'filter' => false,
        'headerOptions' => [
            'style' => 'width:150px;'
        ]
    ];
    array_push($columns, $arins);
}
$view = [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{view}',
];

array_push($columns, $view);
?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title ?></h3>
            </div>
            <div class="card-body">
                <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $columns,
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
