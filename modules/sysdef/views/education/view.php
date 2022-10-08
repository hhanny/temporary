<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Education */

$this->title = $model->education_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Educations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-graduation-cap" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h3>
            <div class="card-options">
                <?= Html::a('<i class="fa fa-pencil"></i> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->education_id], ['class' => 'btn btn-primary btn-sm']) ?>
                <?= Html::a('<i class="fa fa-trash"></i> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->education_id], [
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
                            'education_id',
                            'edu_name',
                            'created_by',
                            'created_time',
                    ],
            ]) ?>
        </div>
    </div>
</div>

