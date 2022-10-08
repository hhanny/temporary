<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClusterRoom */

$this->title = Yii::t('app', 'Update Cluster Room: {name}', [
    'name' => $model->clstroom_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cluster Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->clstroom_id, 'url' => ['view', 'id' => $model->clstroom_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cluster-room-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
