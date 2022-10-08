<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Registration */

$this->title = Yii::t('app', 'Update Registration: {name}', [
    'name' => $model->registration_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Registrations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->registration_id, 'url' => ['view', 'id' => $model->registration_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="registration-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
