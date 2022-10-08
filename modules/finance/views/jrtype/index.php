<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JournalTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Journal Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h3>
            <div class=card-options>
                <?= Html::a('<i class="fa fa-plus-circle" aria-hidden="true"> Create</i>', ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
            </div>
        </div>
        <div class="card-body pt-2">
            <?php Pjax::begin(['clientOptions' => ['method' => 'POST']]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'code',
                    'jrtype_name',
                    [
                        'attribute' => 'jrgroup_id',
                        'value' => function ($model) {
                            return $model->jrgroup->journal_group;
                        },
                        'filter' => \yii\helpers\ArrayHelper::map(\app\models\JournalGroup::find()->all(), 'jrgroup_id', 'journal_group')
                    ],
                    'debet_coa_code',
                    'debet_coa_name',
                    'credit_coa_code',
                    'credit_coa_name',
                    'is_active:boolean',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
                'pager' => [
                    'class' => 'yii\widgets\LinkPager',
                    'options' => ['class' => 'pagination'],
                    'pageCssClass' => 'paginate_button page-item',
                    'prevPageCssClass' => 'paginate_button page-item previous',
                    'nextPageCssClass' => 'paginate_button page-item next',
                    'linkOptions' => ['class' => 'page-link'],
                    'firstPageCssClass' => 'page-item'
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
