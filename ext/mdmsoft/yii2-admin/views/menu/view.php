<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\Menu */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="ion ion-egg"></i> <?= Html::encode($this->title) ?></h3>
            <div class="card-options">
                <?= Html::a('<i class="fa fa-list"></i> ' . Yii::t('app', 'Index'), ['index'], ['class' => 'btn btn-info btn-sm']) ?>
                <?= Html::a('<i class="fa fa-list"></i> ' . Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-primary btn-sm ms-2']) ?>
                <?= Html::a('<i class="fa fa-pencil"></i> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm ms-2']) ?>
                <?= Html::a('<i class="fa fa-trash"></i> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-sm ms-2',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post'
                    ],
                ]) ?>
            </div>
        </div>
        <div class="card-body pt-2">
            <?=
            DetailView::widget(['model' => $model,
                'attributes' => ['menuParent.name:text:Parent',
                    'name',
                    'route',
                    'order',
                    'icon'],])
            ?>
        </div>
    </div>
</div>
