<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
                <div class="ms-auto pageheader-btn pull-right">
                    <?= Html::a('<span><i class="fe fe-plus" aria-hidden="true"></i></span> Add', ['create'], ['class' => 'btn btn-primary btn-icon text-white me-2']) ?>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <?php Pjax::begin(); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'emp_id',
                                'value' => 'employee.employee_id'
                            ],
                            [
                                'attribute' => 'emp_name',
                                'value' => 'employee.person_name'
                            ],
                            [
                                'attribute' => 'username',
                                'filter' => false
                            ],
                            [
                                'attribute' => 'is_active',
                                'filter' => [true => 'Active', false => 'InActive'],
                                'value' => function ($model) {
                                    return $model->is_active ? 'Active' : 'InActive';
                                }
                            ],
                            ['attribute' => 'last_login', 'filter' => false],
                            [
                                'format' => 'raw',
                                'header' => 'Change Password',
                                'value' => function ($data) {
                                    return Html::a('<i class="fa fa-edit"></i> Change Password', \yii\helpers\Url::to(['changepswd', 'id' => $data->user_id]), ['class' => 'btn btn-primary btn-sm']);
                                }
                            ],
                            [
                                'format' => 'raw',
                                'header' => 'Set Hospital',
                                'value' => function ($data) {
                                    return Html::a('<i class="fa fa-hospital-o"></i> Set Hospital', \yii\helpers\Url::to(['sethsptl', 'id' => $data->user_id]), ['class' => 'btn btn-info btn-sm']);
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{view} {delete}',
                                'buttons' => [
                                    'delete' => function ($url) {
                                        return Html::a('<i class="fa fa-trash"></i>', $url, ['title' => 'Delete', 'data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?'), 'data-method' => 'post',
                                                'data-params' => ['_csrf' => Yii::$app->request->csrfToken]
                                            ]
                                        );
                                    }
                                ]
                            ],
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
