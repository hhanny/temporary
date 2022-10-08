<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InventoryGroup */

$this->title = Yii::t('app', 'Update Inventory Group: {name}', [
        'name' => $model->invgroup_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inventory Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->invgroup_id, 'url' => ['view', 'id' => $model->invgroup_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body pt-2">
            <?= $this->render('_form', [
                    'model' => $model,
                    'readonly' => true
            ]) ?>
        </div>
    </div>
</div>
