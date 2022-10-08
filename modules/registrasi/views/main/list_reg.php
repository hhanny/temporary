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

$this->title = Yii::t('app', 'Registrations');
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Pasien Aktif Rawat Jalan & IGD</h3>
                </div>
                <div class="card-body">
                    <?php Pjax::begin(['clientOptions' => ['method' => 'POST']]); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'reg_num',
                            'mr_number',
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
                            ],
                            [
                                'header' => 'Rawat Inap',
                                'headerOptions' => ['style' => 'text-align: center !important;'],
                                'contentOptions' => ['style' => 'text-align: center !important;'],
                                'format' => 'raw',
                                'value' => function ($model) {
//                                    return Html::a('Daftar', 'javascript:void(0)', [
//                                        'class' => 'btn btn-primary btn-sm',
//                                        'onclick' => 'daftar(' . $model->registration_id . ')'
//                                    ]);
                                    return Html::a('Daftar', Url::toRoute(['inap/new', 'rID' => $model->registration_id]), ['class' => 'btn btn-primary btn-sm']);
                                }
                            ]
                        ],
                        'pager' => [
                            'class' => 'yii\widgets\LinkPager',
                            'options' => ['class' => 'pagination'],
                            'pageCssClass' => 'paginate_button page-item',
                            'prevPageCssClass' => 'paginate_button page-item previous',
                            'nextPageCssClass' => 'paginate_button page-item next',
                            'linkOptions' => ['class' => 'page-link'],
                            'firstPageCssClass' => 'page-item'
                        ]
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>

<?php
$urlDaftar = Url::toRoute(['inap/new']);
$sJs = <<<JS
    function daftar(id){
        var urlDaftar = '$urlDaftar'+'?rID='+id;
        window.location = urlEncode(urlDaftar);
    }
JS;
$this->registerJs($sJs, \yii\web\View::POS_END);
?>