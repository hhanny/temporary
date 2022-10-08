<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\InventoryGroup;
use app\models\InventoryLargeUnit;
use app\models\InventorySmallUnit;
use app\models\InventoryType;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InventorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Inventories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h3>
            <div class=card-options>
                <?= Html::a('<i class="fa fa-plus-circle" aria-hidden="true"> Create</i>', ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
            </div>
        </div>
        <div class="card-body pt-2">
            <?php Pjax::begin(['clientOptions' => ['method' => 'POST']]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    'internal_name',
                    [
                        'attribute' => 'invgroup_id',
                        'value' => function ($model) {
                            return $model->invgroup->inv_group;
                        },
                        'filter' => ArrayHelper::map(InventoryGroup::getActive(), 'invgroup_id', 'inv_group')
                    ],
                    [
                        'attribute' => 'invtype_id',
                        'value' => function ($model) {
                            return $model->invtype->inv_name;
                        },
                        'filter' => ArrayHelper::map(InventoryType::find()->active()->all(), 'invtype_id', 'inv_name')
                    ],
                    [
                        'attribute' => 'largeunit_id',
                        'value' => function ($model) {
                            return $model->largeunit->large_unit;
                        },
                        'filter' => ArrayHelper::map(InventoryLargeUnit::find()->active()->all(), 'largeunit_id', 'large_unit')
                    ],
                    [
                        'attribute' => 'smallunit_id',
                        'value' => function ($model) {
                            return $model->smallunit->small_unit;
                        },
                        'filter' => ArrayHelper::map(InventorySmallUnit::find()->active()->all(), 'smallunit_id', 'small_unit')
                    ],
                    'is_active:boolean',
                    [
                        'header' => 'Set Harga',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a('<i class="fa fa-money"></i>', Url::toRoute(['view', 'id' => $model->inv_id]));
                        },
                        'headerOptions' => [
                            'style' => 'text-align:center;'
                        ],
                        'contentOptions' => [
                            'style' => 'text-align:center;'
                        ]
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update} {delete}'
                    ],
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
