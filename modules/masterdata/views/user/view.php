<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> View User: <?= Html::encode($this->title) ?></h3>
            <div class="card-options">
                <?= Html::a('<i class="fa fa-list"></i> ' . Yii::t('app', 'Index'), ['index'], ['class' => 'btn btn-secondary btn-sm']) ?>
                <?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success btn-sm ms-2']) ?>
                <?= Html::a('<i class="fa fa-trash"></i> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->user_id], [
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
                            'user_id',
                            'hospital.name',
                            'employee.employee_id',
                            'employee.person_name',
                            'username',
                            'password_hash',
                            'is_active:boolean',
                            'last_login',
                            'created_by',
                            'created_time',
                    ],
            ]) ?>
        </div>
    </div>
</div>
