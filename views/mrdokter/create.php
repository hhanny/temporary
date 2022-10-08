<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mrdokter */

$this->title = 'Create Mrdokter';
$this->params['breadcrumbs'][] = ['label' => 'Mrdokters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mrdokter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
