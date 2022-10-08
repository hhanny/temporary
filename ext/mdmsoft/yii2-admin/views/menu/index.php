<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\Menu */

$this->title = Yii::t('rbac-admin', 'Menu');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-check"></i> <?= Html::encode($this->title) ?></h3>
            <div class=card-options>
                <?= Html::a('<i class="fa fa-plus-circle"> Create</i>', ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
            </div>
        </div>
        <div class="card-body pt-2">
            <?php Pjax::begin(['clientOptions' => ['method' => 'POST']]); ?>
            <?=
            GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'name',
                            [
                                    'attribute' => 'menuParent.name',
                                    'filter' => Html::activeTextInput($searchModel, 'parent_name', [
                                            'class' => 'form-control', 'id' => null
                                    ]),
                                    'label' => Yii::t('rbac-admin', 'Parent'),
                            ],
                            'route',
                            'order',
                            'icon',
                            [
                                    'class' => 'yii\grid\ActionColumn',
                                    'headerOptions' => ['style' => 'width:70px']
                            ],
                    ],
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
