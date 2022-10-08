<?php

use app\models\Patient;
use app\models\Gender;
use app\models\Religion;
use app\models\BloodType;
use app\models\Education;
use app\models\MaritalStatus;
use app\models\Ethnic;
use app\models\Job;
use app\models\Registration;
use app\models\Doctor;
use app\models\Unit;
use app\models\PatientRate;
use app\models\PatientGuaranty;
use app\models\RegistrationReference;
use app\models\PicRelation;
use app\models\Emergency;
use app\models\EmergencyReason;
use app\models\RegistrationInpatient;
use app\models\ClusterRoom;
use app\models\Room;
use app\models\Bed;
use app\models\ClassRoom;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

if (isset($mdl2->unit_id)) {
    $title = $mdl2->unit->unit_name;
} else {
    $title = 'Rawat Jalan';
}
?>
<?= $this->render('_headbtn', ['title' => $title]) ?>
<?php $form = ActiveForm::begin(['options' => ['id' => 'newRegistration', 'class' => 'needs-validation']]) ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pasien</h3>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom01"><?= Patient::instance()->getAttributeLabel('mr_number') ?></label>
                        <?= $form->field($mdl1, 'mr_number')->textInput(['required' => true])->label(false) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom02"><?= Patient::instance()->getAttributeLabel('fullname') ?></label>
                        <?= $form->field($mdl1, 'fullname')->textInput(['required' => true])->label(false) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom03"><?= Patient::instance()->getAttributeLabel('nickname') ?></label>
                        <?= $form->field($mdl1, 'nickname')->textInput(['required' => true])->label(false) ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom04"><?= Patient::instance()->getAttributeLabel('birth_place') ?></label>
                        <?= $form->field($mdl1, 'birth_place')->textInput(['required' => true])->label(false) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom05"><?= Patient::instance()->getAttributeLabel('date_of_birth') ?></label>
                        <?= $form->field($mdl1, 'date_of_birth')->textInput(['required' => true, 'class' => 'form-control fc-datepicker'])->label(false) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom06"><?= Patient::instance()->getAttributeLabel('gender_id') ?></label>
                        <?= $form->field($mdl1, 'gender_id')->dropDownList(ArrayHelper::map(Gender::find()->all(), 'gender_id', 'name'), ['prompt' => 'Select'])->label(false) ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom07"><?= Patient::instance()->getAttributeLabel('religion_id') ?></label>
                        <?= $form->field($mdl1, 'religion_id')->dropDownList(ArrayHelper::map(Religion::find()->orderBy('s_order')->all(), 'religion_id', 'name'), ['prompt' => 'Select'])->label(false) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom08"><?= Patient::instance()->getAttributeLabel('blood_id') ?></label>
                        <?= $form->field($mdl1, 'blood_id')->dropDownList(ArrayHelper::map(BloodType::find()->orderBy('s_order')->all(), 'blood_id', 'name'), ['prompt' => 'Select'])->label(false) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom09"><?= Patient::instance()->getAttributeLabel('education_id') ?></label>
                        <?= $form->field($mdl1, 'education_id')->dropDownList(ArrayHelper::map(Education::find()->orderBy('s_order')->all(), 'education_id', 'edu_name'), ['prompt' => 'Select'])->label(false) ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom10"><?= Patient::instance()->getAttributeLabel('address') ?></label>
                        <?= $form->field($mdl1, 'address')->textInput(['required' => true])->label(false) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom11"><?= Patient::instance()->getAttributeLabel('village') ?></label>
                        <?= $form->field($mdl1, 'village')->textInput(['required' => true])->label(false) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom12"><?= Patient::instance()->getAttributeLabel('subdistrict_id') ?></label>
                        <?php
                        $selSubDis = null;
                        if (isset($mdl1->patient_id)) {
                            $selSubDis = [$mdl1->subdistrict_id => $mdl1->fulladdress];
                        }
                        ?>
                        <?= $form->field($mdl1, 'subdistrict_id')->dropDownList($selSubDis, ['prompt' => 'Select', 'class' => 'form-control select2-show-search form-select subdistrict'])->label(false) ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom13"><?= Patient::instance()->getAttributeLabel('marital_status_id') ?></label>
                        <?= $form->field($mdl1, 'marital_status_id')->dropDownList(ArrayHelper::map(MaritalStatus::find()->all(), 'marital_status_id', 'name'), ['class' => 'form-control', 'prompt' => 'Select'])->label(false) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom14"><?= Patient::instance()->getAttributeLabel('ethnic_id') ?></label>
                        <?= $form->field($mdl1, 'ethnic_id')->dropDownList(ArrayHelper::map(Ethnic::find()->orderBy('ethnic_name')->all(), 'ethnic_id', 'ethnic_name'), ['prompt' => 'Select'])->label(false) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom15"><?= Patient::instance()->getAttributeLabel('phone') ?></label>
                        <?= $form->field($mdl1, 'phone')->textInput(['required' => true])->label(false) ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom16"><?= Patient::instance()->getAttributeLabel('job_id') ?></label>
                        <?= $form->field($mdl1, 'job_id')->dropDownList(ArrayHelper::map(Job::find()->orderBy('s_order')->where(['hospital_id' => Yii::$app->user->identity->hospital_id])->all(), 'job_id', 'name'), ['prompt' => 'Select'])->label(false) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom17"><?= Patient::instance()->getAttributeLabel('office_address') ?></label>
                        <?= $form->field($mdl1, 'office_address')->textInput(['required' => true])->label(false) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom18"><?= Patient::instance()->getAttributeLabel('identity_number') ?></label>
                        <?= $form->field($mdl1, 'identity_number')->textInput(['required' => true])->label(false) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Registrasi</h3>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault19"><?= Registration::instance()->getAttributeLabel((isset($mdl3) ? 'Unit Asal' : 'unit_id')) ?></label>
                        <?php
                        /*
                         * case untuk pendaftaran IGD, dropdown hanya di select sebagai unit IGD
                         */
                        $lUnit = ArrayHelper::map(Unit::find()->clinic()->all(), 'unit_id', 'unit_name');
                        $disabled = false;
                        if (isset($mdl2->unit_id)) {
                            $lUnit = [$mdl2->unit_id => $mdl2->unit->unit_name];
                            $disabled = true;
                            echo Html::dropDownList('unit', $mdl2->unit_id, $lUnit, ['class' => 'form-control', 'disable' => $disabled]);
                            echo $form->field($mdl2, 'unit_id')->hiddenInput()->label(false);
                        } else {
                            echo $form->field($mdl2, 'unit_id')->dropDownList($lUnit, ['prompt' => 'Select', 'disabled' => $disabled])->label(false);
                        }
                        ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault20"><?= Registration::instance()->getAttributeLabel('doctor_id') ?></label>
                        <?= $form->field($mdl2, 'doctor_id')->dropDownList(ArrayHelper::map(Doctor::getActive(), 'doctor_id', 'fullname'), ['prompt' => 'Select'])->label(false) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault21"><?= Registration::instance()->getAttributeLabel('rate_id') ?></label>
                        <?= $form->field($mdl2, 'rate_id')->dropDownList(ArrayHelper::map(PatientRate::getActive(), 'rate_id', 'name'), ['prompt' => 'Select'])->label(false) ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationDefault22"><?= Registration::instance()->getAttributeLabel('guaranty_id') ?></label>
                        <?= $form->field($mdl2, 'guaranty_id')->dropDownList(ArrayHelper::map(PatientGuaranty::getActive(), 'guaranty_id', 'name'), ['prompt' => 'Select'])->label(false) ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationDefault23"><?= Registration::instance()->getAttributeLabel('regref_id') ?></label>
                        <?= $form->field($mdl2, 'regref_id')->dropDownList(ArrayHelper::map(RegistrationReference::getActive(), 'regref_id', 'name'), ['prompt' => 'Select'])->label(false) ?>
                    </div>
                </div>
                <?php if ($mdl2->unit->unitgroup_id == Registration::UG_IGD) : ?>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault22"><?= Registration::instance()->getAttributeLabel('reason_id') ?></label>
                            <?= $form->field($mdl2, 'reason_id')->dropDownList(ArrayHelper::map(EmergencyReason::find()->orderBy('s_order')->all(), 'reason_id', 'name'), ['prompt' => 'Select'])->label(false) ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault22"><?= Registration::instance()->getAttributeLabel('emergency_id') ?></label>
                            <?= $form->field($mdl2, 'emergency_id')->dropDownList(ArrayHelper::map(Emergency::find()->orderBy('s_order')->all(), 'emergency_id', 'name'), ['prompt' => 'Select'])->label(false) ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault22"><?= Registration::instance()->getAttributeLabel('sender_name') ?></label>
                            <?= $form->field($mdl2, 'sender_name')->textInput(['class' => 'form-control'])->label(false) ?>
                        </div>
                    </div>
                <?php endif ?>
                <?php if (isset($mdl3)) : ?>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault22"><?= RegistrationInpatient::instance()->getAttributeLabel('sClusterName') ?></label>
                            <?= $form->field($mdl3, 'sClusterName')->dropDownList(ArrayHelper::map(ClusterRoom::getActive(), 'clstroom_id', 'cls_room'), ['id' => 'clusterRoom', 'prompt' => 'Select'])->label(false) ?>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault23"><?= RegistrationInpatient::instance()->getAttributeLabel('sRoomName') ?></label>
                            <?= $form->field($mdl3, 'sRoomName')->dropDownList(ArrayHelper::map(Room::getActive(), 'room_id', 'room_name'), ['id' => 'roomID', 'prompt' => 'Select'])->label(false) ?>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault23"><?= RegistrationInpatient::instance()->getAttributeLabel('bed_id') ?></label>
                            <?= $form->field($mdl3, 'bed_id')->dropDownList(ArrayHelper::map(Bed::getActive(), 'bed_id', 'bed_num'), ['id' => 'bedID', 'prompt' => 'Select'])->label(false) ?>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault23"><?= RegistrationInpatient::instance()->getAttributeLabel('class_id') ?></label>
                            <?= $form->field($mdl3, 'class_id')->dropDownList(ArrayHelper::map(ClassRoom::getActive(), 'class_id', 'class_name'), ['prompt' => 'Select'])->label(false) ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pananggung Jawab</h3>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault24"><?= Registration::instance()->getAttributeLabel('pic_name') ?></label>
                        <?= $form->field($mdl2, 'pic_name')->textInput(['required' => true])->label(false) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault25"><?= Registration::instance()->getAttributeLabel('picrel_id') ?></label>
                        <?= $form->field($mdl2, 'picrel_id')->dropDownList(ArrayHelper::map(PicRelation::getActive(), 'picrel_id', 'name'))->label(false) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault26"><?= Registration::instance()->getAttributeLabel('pic_phone') ?></label>
                        <?= $form->field($mdl2, 'pic_phone')->textInput(['required' => true])->label(false) ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationDefault27"><?= Registration::instance()->getAttributeLabel('pic_address') ?></label>
                        <?= $form->field($mdl2, 'pic_address')->textInput(['required' => true])->label(false) ?>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>
<?php
$callRegion = Url::toRoute(['/apisrv/v1/region/getlist']);
$submitReg = Url::toRoute(['/apisrv/v1/registration/newreg']);
$callRoom = Url::toRoute(['/apisrv/v1/room/getlist']);
$callBed = Url::to(['/apisrv/v1/bed/getlist']);
$nextPage = 'main/patactive';
if (Yii::$app->controller->id == 'inap') {
    $nextPage = Yii::$app->controller->id . '/pactive';
}
$idxUrl = Url::toRoute([$nextPage]);
$pid = (isset($mdl1->patient_id) ? $mdl1->patient_id : 0);
$rid = (isset($mdl2->registration_id) ? $mdl2->registration_id : 0);
$sJs = <<<JS
    $(document).ready(function(){
       $("#clusterRoom").on('change', function(){
           var clsId = $(this).val();
           $.post('$callRoom', {id: clsId}, function(result){
                $( "select#roomID" ).html(result);
                $( "select#bedID").html("<option>Select</option>");
              });
       });
       $("#roomID").on('change', function (){
           var roomid =  $(this).val();
           $.post('$callBed', {id: roomid}, function(result){
                $( "select#bedID" ).html(result);
              }); 
       });
       $(".subdistrict").on('click', function(){
           $('.subdistrict')[0].focus();
       }); 
       $(".subdistrict").select2({
            placeholder: "Select Region",
            ajax: {
                url: '$callRegion',
                type: 'POST',
                dataType: 'json',
                data: function (params) {
                    return {
                        key: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 10) < data.total_count
                        }
                    };
                }
            }
       });
       $('.fc-datepicker').mask('99-99-9999');
       $('#newRegistration').on('submit', function (event) {
            event.preventDefault();
            event.stopImmediatePropagation();
            var data = new FormData($("#" + $(this).attr('id'))[0]);
            var pid = $pid;
            var rid = $rid;
            if(pid != null){
                data.append('pid', pid);
                data.append('rid', rid);
            }
            swal({
                title: "Peringatan",
                text: "apakah anda yakin?",
                type: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: 'Ya',
                confirmButtonClass: "btn-primary",
                cancelButtonText: 'No',
                cancelButtonClass: "btn-danger",
            }, function(isConfirm){
                console.log(isConfirm);
                if(isConfirm){
                    $.ajax({
                            type: "POST",
                            url: '$submitReg',
                            processData: false,
                            contentType: false,
                            dataType: "json",
                            data: data,
                            beforeSend: function () {
                                $("#loadloader").html('<div class="dimmer active"> <div class="spinner"></div> </div>');
                                $("#loadformcontent").hide();
                            },
                            success: function (data) {
                                if (data.code == 200) {
                                    $('#loadmodal').modal('hide');
                                    swal({
                                        title: "Success",
                                        text: data.message,
                                        type: "success"
                                    }, function (){
                                        window.location = '$idxUrl';
                                    });
                                } else {
                                    swal('Failed','' + data.message + '', 'error');
                                }
                            },
                            complete: function () {
                                $("#loadformloader").html('');
                                $("#loadformcontent").show();
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                var pesan = xhr.status + " " + thrownError + " " + xhr.responseText;
                                $("#loadformcontent").html('<div class="alert alert-danger dark" role="alert"><i class="icofont icofont-warning-alt"></i> ' + pesan + '</div>');
                            },
                        });
                }
            });
        });
    });
JS;
$this->registerJs($sJs);
?>
