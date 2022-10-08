<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\ClassRoom;

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
                    <h3 class="card-title">Informasi Pasien Aktif Rawat Inap</h3>
                </div>
                <div class="card-body">
                    <?php Pjax::begin(['clientOptions' => ['method' => 'POST']]); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'sRNum',
                                'value' => function ($model) {
                                    return $model->registration->reg_num;
                                }
                            ],
                            [
                                'attribute' => 'sMRNum',
                                'value' => function ($model) {
                                    return $model->registration->mr_number;
                                }
                            ],
                            [
                                'attribute' => 'sPName',
                                'value' => function ($model) {
                                    return $model->registration->patient->fullname;
                                }
                            ],
                            [
                                'attribute' => 'class_id',
                                'value' => function ($model) {
                                    return $model->class->class_name;
                                },
                                'filter' => ArrayHelper::map(ClassRoom::getActive(), 'class_id', 'class_name')
                            ],
                            [
                                'attribute' => 'sClusterName',
                                'value' => function ($model) {
                                    return $model->bed->room->clstroom->cls_room;
                                }
                            ],
                            [
                                'attribute' => 'sRoomName',
                                'value' => function ($model) {
                                    return $model->bed->room->room_name;
                                }
                            ],
                            [
                                'attribute' => 'sBedNum',
                                'value' => function ($model) {
                                    return $model->bed->bed_num;
                                }
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
                        ],
                        'pager' => [
                            'class' => 'yii\widgets\LinkPager',
                            'options' => ['class' => 'pagination'],
                            'pageCssClass' => 'paginate_button page-item',
                            'prevPageCssClass' => 'paginate_button page-item previous',
                            'nextPageCssClass' => 'paginate_button page-item next',
                            'linkOptions' => ['class' => 'page-link'],
                            'firstPageCssClass' => 'page-item'
                        ],
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