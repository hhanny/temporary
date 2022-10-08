<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Hospital;
use app\models\ClusterRoom;
use app\models\Room;

/* @var $this yii\web\View */
/* @var $model app\models\Bed */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bed-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hospital_id')->dropDownList(ArrayHelper::map(Hospital::getActive(), 'hospital_id', 'name')) ?>

    <?php
    $listData = null;
    if ($model !== null) {
        $listData = ArrayHelper::map(Room::find()->where(['clstroom_id' => $model->room->clstroom_id])->all(), 'room_id', 'room_name');
        $model->sClusterName = $model->room->clstroom_id;
    }
    ?>

    <?= $form->field($model, 'sClusterName')->dropDownList(ArrayHelper::map(ClusterRoom::getActive(), 'clstroom_id', 'cls_room'),
            [
                    'prompt' => 'Select',
                    'onchange' => '$.get( "' . Url::to(['listroom']) . '?id="+$(this).val(), function( data ) {
				  $( "select#roomID" ).html( data );
				});'
            ]
    ) ?>

    <?= $form->field($model, 'room_id')->dropDownList($listData, ['id' => 'roomID']) ?>

    <?= $form->field($model, 'bed_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$urlData = Url::toRoute(['apisrv/v1/clusterroom/getlist']);
$sJs = <<<JS
$(document).ready(function(){
    $("#cluster").on('change', function(){
        var dataId = $(this).val();
        $.ajax({
            type: "POST",
            url: '$urlData',
            data: {
                key: dataId
            },
            success: function (data) {
                $('#roomID').append(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var pesan = xhr.status + " " + thrownError + " " + xhr.responseText;
                $("#loadformcontent").html('<div class="alert alert-danger dark" role="alert"><i class="icofont icofont-warning-alt"></i> ' + pesan + '</div>');
            }
        });
    });
});
JS;
$this->registerJs($sJs);
?>
