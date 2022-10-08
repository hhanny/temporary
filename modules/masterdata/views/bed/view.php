<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bed */

$this->title = $model->bed_num;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Beds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h3>
            <div class="card-options">
                <?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
                <?= Html::a('<i class="fa fa-pencil"></i> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->room_id], ['class' => 'btn btn-primary btn-sm ms-2']) ?>
                <?= Html::a('<i class="fa fa-trash"></i> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->room_id], [
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
                            'bed_id',
                            'hospital.name',
                            'room.room_name',
                            'bed_num',
                            'is_active:boolean',
                            'is_available:boolean',
                            [
                                    'attribute' => 'last_used_by',
                                    'value' => function ($model) {
                                        return $model->lastUsedBy->reg_num . '/' . $model->lastUsedBy->mr_number . '/' . $model->lastUsedBy->patient->fullname;
                                    }
                            ],
                            [
                                    'attribute' => 'created_by',
                                    'value' => function ($model) {
                                        return $model->createdBy->employee->person_name;
                                    }
                            ],
                            'created_time',
                            [
                                    'attribute' => 'updated_by',
                                    'value' => function ($model) {
                                        return $model->updatedBy->employee->person_name;
                                    }
                            ],
                            'updated_time'
                    ],
            ]) ?>
        </div>
    </div>
</div>
