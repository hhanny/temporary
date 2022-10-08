<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Employees');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-group" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h3>
            <div class=card-options>
                <?= Html::a('<i class="fa fa-plus-circle"> Create</i>', ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
            </div>
        </div>
        <div class="card-body pt-2">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'employee_id',
                            'person_name',
                            'email:email',
                            ['attribute' => 'phone', 'filter' => false],
                            'address',
                        //'hospital_id',
                            ['attribute' => 'created_by', 'filter' => false],
                            ['attribute' => 'created_time', 'filter' => false],
                            [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{view} {update} {delete}',
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
