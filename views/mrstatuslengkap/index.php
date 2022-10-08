<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MrstatuslengkapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mrstatuslengkaps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mrstatuslengkap-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mrstatuslengkap', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'statuslengkap_id',
            'nama_statuslengkap',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
