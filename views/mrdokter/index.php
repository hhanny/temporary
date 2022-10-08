<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MrdokterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mrdokters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mrdokter-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mrdokter', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'dokter_id',
            'dokter_code',
            'spesialis',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
