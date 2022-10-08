<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Beds');
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
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                    'attribute' => 'sClusterName',
                                    'value' => function ($model) {
                                        return $model->room->clstroom->cls_room;
                                    }
                            ],
                            [
                                    'attribute' => 'sRoomName',
                                    'value' => function ($model) {
                                        return $model->room->room_name;
                                    }
                            ],
                            'bed_num',
                            'is_active:boolean',
                            'is_available:boolean',
                            [
                                    'attribute' => 'last_used_by',
                                    'filter' => false,
                                    'value' => function ($model) {
                                        return ($model->last_used_by != null ? $model->lastUsedBy->reg_num . '/' . $model->lastUsedBy->mr_number . '/' . $model->lastUsedBy->patient->fullname : null);
                                    }
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                    ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
