<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subdistrict */

$this->title = Yii::t('app', 'Create Subdistrict');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subdistricts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-flag-o" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body pt-2">
            <?= $this->render('_form', [
                    'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
