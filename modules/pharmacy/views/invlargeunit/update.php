<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InventoryLargeUnit */

$this->title = Yii::t('app', 'Update Inventory Large Unit: {name}', [
    'name' => $model->largeunit_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inventory Large Units'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->largeunit_id, 'url' => ['view', 'id' => $model->largeunit_id]];
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
