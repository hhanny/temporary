<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ethnic */

$this->title = Yii::t('app', 'Update Ethnic: {name}', [
    'name' => $model->ethnic_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ethnics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ethnic_id, 'url' => ['view', 'id' => $model->ethnic_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ethnic-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
