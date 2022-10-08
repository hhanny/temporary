<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mrstatuslengkap */

$this->title = 'Create Mrstatuslengkap';
$this->params['breadcrumbs'][] = ['label' => 'Mrstatuslengkaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mrstatuslengkap-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
