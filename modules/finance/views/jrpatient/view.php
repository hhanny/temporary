<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Journal */

$this->title = $model->journal_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Journals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="journal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->journal_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->journal_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'journal_id',
            'hospital_id',
            'registration_id',
            'jrgroup_id',
            'jr_num',
            'description:ntext',
            'entry_date',
            'is_posting:boolean',
            'user_posting',
            'posting_date',
            'posting_time',
            'posting_shift',
            'jtype_id',
            'created_by',
            'created_time',
            'updated_by',
            'updated_time',
            'is_deleted:boolean',
            'deleted_by',
            'deleted_time',
            'payment_id',
        ],
    ]) ?>

</div>
