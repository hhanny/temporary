<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\components\Formatter;

/* @var $this yii\web\View */
/* @var $model app\models\Inventory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inventories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-lg-4 col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> <?= Html::encode($this->title) ?>
                </h3>
                <div class="card-options">
                    <?= Html::a('<i class="fa fa-list"></i> ' . Yii::t('app', 'Index'), ['index'], ['class' => 'btn btn-info btn-sm']) ?>
                    <?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success btn-sm ms-2']) ?>
                    <?= Html::a('<i class="fa fa-pencil"></i> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->invgroup_id], ['class' => 'btn btn-primary btn-sm ms-2']) ?>
                    <?= Html::a('<i class="fa fa-trash"></i> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->invgroup_id], [
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
                        'inv_id',
                        'hospital.name',
                        'name',
                        'current_faktor',
                        'suggested_faktor',
                        'internal_name',
                        'invgroup.inv_group',
                        'largeunit.large_unit',
                        'smallunit.small_unit',
                        'created_time',
                        [
                            'attribute' => 'updated_by',
                            'value' => function ($model) {
                                return $model->updatedBy->employee->person_name;
                            }
                        ],
                        'updated_time',
                        'is_deleted:boolean',
                        [
                            'attribute' => 'deleted_by',
                            'value' => function ($model) {
                                return $model->deletedBy->employee->person_name;
                            }
                        ],
                        'deleted_time'
                    ],
                ]) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> Harga : <?= $this->title ?></h3>
            </div>
            <div class="card-body">
                <?= GridView::widget([
                    'dataProvider' => $rate,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'sk_num',
                        [
                            'attribute' => 'start_date',
                            'value' => function ($model) {
                                return date('d-m-Y', strtotime($model->start_date));
                            }
                        ],
                        [
                            'attribute' => 'end_date',
                            'value' => function ($model) {
                                return date('d-m-Y', strtotime($model->end_date));
                            }
                        ],
                        'is_active',
                        [
                            'attribute' => 'price_nominal',
                            'contentOptions' => [
                                'style' => 'text-align:right;'
                            ],
                            'value' => function ($model) {
                                return Formatter::formatNumber($model->price_nominal);
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
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
