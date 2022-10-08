<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mrdokter */

$this->title = 'Update Mrdokter: ' . $model->dokter_id;
$this->params['breadcrumbs'][] = ['label' => 'Mrdokters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dokter_id, 'url' => ['view', 'id' => $model->dokter_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mrdokter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
