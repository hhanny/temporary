<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductRate */

$this->title = Yii::t('app', 'Update Product Rate: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Rates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->prdrate_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-list"></i> <?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body pt-2">
            <?= $this->render('_form', [
                'model' => $model,
                'readonly' => true
            ]) ?>
        </div>
    </div>
</div>
