<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Hospital;
use app\models\UnitGroup;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h3>
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
                    [
                        'attribute' => 'product_id',
                        'filter' => false
                    ],
                    [
                        'attribute' => 'hospital_id',
                        'value' => function ($model) {
                            return $model->hospital->name;
                        },
                        'filter' => ArrayHelper::map(Hospital::find()->all(), 'hospital_id', 'name')
                    ],
                    [
                        'attribute' => 'unitgroup_id',
                        'value' => function ($model) {
                            return $model->unitgroup->name;
                        },
                        'filter' => ArrayHelper::map(UnitGroup::find()->all(), 'unitgroup_id', 'name')
                    ],
                    'coa_id',
                    'name',
                    'is_active:boolean',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
