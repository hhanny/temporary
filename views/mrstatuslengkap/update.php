<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mrstatuslengkap */

$this->title = 'Update Mrstatuslengkap: ' . $model->statuslengkap_id;
$this->params['breadcrumbs'][] = ['label' => 'Mrstatuslengkaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->statuslengkap_id, 'url' => ['view', 'id' => $model->statuslengkap_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mrstatuslengkap-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
