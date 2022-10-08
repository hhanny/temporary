<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PurchaseOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Purchase Orders');
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
                    'po_id',
                    'hospital_id',
                    'po_num',
                    'po_date',
                    'supplier_id',
                    //'unit_id',
                    //'po_note:ntext',
                    //'ref_num',
                    //'ref_date',
                    //'due_date',
                    //'pay_plan_date',
                    //'potype_id',
                    //'ppn_prosen',
                    //'ppn_nominal',
                    //'created_by',
                    //'created_time',
                    //'updated_by',
                    //'updated_time',
                    //'is_deleted:boolean',
                    //'deleted_by',
                    //'deleted_time',
                    //'receive_date',
                    //'tax_num',
                    //'paytype_id',

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
                ]
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
