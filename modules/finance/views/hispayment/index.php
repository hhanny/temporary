<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\Formatter;
use app\models\PaymentType;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', $title);
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
                    [
                        'attribute' => 'paytype_id',
                        'value' => function ($model) {
                            return $model->paytype->name;
                        },
                        'filter' => ArrayHelper::map(PaymentType::find()->active()->all(), 'paytype_id', 'name')
                    ],
                    [
                        'attribute' => 'reg_num',
                        'value' => function ($model) {
                            return $model->registration->reg_num;
                        }
                    ],
                    [
                        'attribute' => 'pasien_norm',
                        'value' => function ($model) {
                            return $model->registration->mr_number;
                        }
                    ],
                    [
                        'attribute' => 'pasien_name',
                        'value' => function ($model) {
                            return $model->registration->patient->fullname;
                        }
                    ],
                    [
                        'attribute' => 'patient_guaranty',
                        'value' => function ($model) {
                            return $model->registration->guaranty->name;
                        }
                    ],
                    [
                        'attribute' => 'nominal',
                        'contentOptions' => [
                            'style' => 'text-align:right;'
                        ],
                        'value' => function ($model) {
                            return Formatter::formatNumber($model->nominal);
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}'
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
