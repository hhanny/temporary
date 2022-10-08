<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\PurchaseOrder;
use app\models\Supplier;
use app\models\PurchaseOrderType;
use app\models\Unit;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title ?></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01"><?= PurchaseOrder::instance()->getAttributeLabel('po_num') ?></label>
                            <?= $form->field($model, 'po_num')->textInput(['maxlength' => true])->label(false) ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom02"><?= PurchaseOrder::instance()->getAttributeLabel('po_date') ?></label>
                            <?= $form->field($model, 'po_date')->textInput(['class' => 'form-control fc-datepicker'])->label(false) ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom03"><?= PurchaseOrder::instance()->getAttributeLabel('supplier_id') ?></label>
                            <?= $form->field($model, 'supplier_id')->dropDownList(ArrayHelper::map(Supplier::getActive(), 'supplier_id', 'name'), ['prompt' => 'Select', 'class' => 'select2-show-search form-select select2'])->label(false) ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom04"><?= PurchaseOrder::instance()->getAttributeLabel('potype_id') ?></label>
                            <?= $form->field($model, 'potype_id')->dropDownList(ArrayHelper::map(PurchaseOrderType::find()->isPharmacy()->all(), 'potype_id', 'po_type'), ['prompt' => 'Select'])->label(false) ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom05"><?= PurchaseOrder::instance()->getAttributeLabel('due_date') ?></label>
                            <?= $form->field($model, 'due_date')->textInput(['class' => 'form-control fc-datepicker'])->label(false) ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom07"><?= PurchaseOrder::instance()->getAttributeLabel('unit_id') ?></label>
                            <?= $form->field($model, 'unit_id')->dropDownList(ArrayHelper::map(Unit::find()->struktural()->orderBy('unit_name')->all(), 'unit_id', 'unit_name'), ['prompt' => 'Select'])->label(false) ?>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom11"><?= PurchaseOrder::instance()->getAttributeLabel('po_note') ?></label>
                            <?= $form->field($model, 'po_note')->textInput()->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Obat</th>
                            <th>Batch</th>
                            <th>ED</th>
                            <th>Banyak</th>
                            <th>Faktor</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script>
    $('.select2').select2();
    $('.fc-datepicker').bootstrapdatepicker({
        format: "dd-mm-yyyy",
        viewMode: "date",
        autoclose: true,
        multidateSeparator: "-",
    })
</script>
