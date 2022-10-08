<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CoaCategory */

$this->title = Yii::t('app', 'Update Coa Category: {name}', [
        'name' => $model->ccat_code,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Coa Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ccat_code, 'url' => ['view', 'id' => $model->ccat_code]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-list" aria-hidden="true"/> <?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body pt-2">
            <?= $this->render('_form', [
                    'model' => $model,
                    'readonly' => true
            ]) ?>
        </div>
    </div>
</div>
