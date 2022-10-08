<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\Formatter;

/* @var $this yii\web\View */
/* @var $model app\models\Payment */

$this->title = $model->payment_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body pt-2">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'payment_id',
                    'hospital.name',
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
                    'paytype.name',
                    'nonpatient_id',
                    'is_patient:boolean',
                    'description:ntext',
                    [
                        'attribute' => 'nominal',
                        'value' => function ($model) {
                            return Formatter::formatNumber($model->nominal);
                        }
                    ],
                    [
                        'attribute' => 'created_by',
                        'value' => function ($model) {
                            return $model->createdBy->employee->person_name;
                        }
                    ],
                    'created_time',
                    'is_deleted:boolean',
                    [
                        'attribute' => 'deleted_by',
                        'value' => function ($model) {
                            return $model->deletedBy->employee->person_name;
                        }
                    ],
                    'deleted_time',
                ],
            ]) ?>
        </div>
    </div>
</div>
