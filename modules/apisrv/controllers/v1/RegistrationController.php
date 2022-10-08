<?php


namespace app\modules\apisrv\controllers\v1;

use app\models\Bed;
use app\models\RegistrationInpatient;
use Yii;
use app\components\Apisrv1Controller;
use app\models\Patient;
use app\models\Registration;
use yii\web\Response;
use yii\db\Exception;

class RegistrationController extends Apisrv1Controller
{
    /*
     * berlaku untuk pendaftaran rawat jalan, igd dan rawat inap
     * jika pasien_id = 0 atau null maka pendaftaran pasien baru
     * jika pasien_id != 0 atau != null maka pendaftaran pasien lama
     * jika registration_id !=0 atau != null maka pendaftaran rawat inap
     */
    public function actionNewreg()
    {
        $status = null;
        $code = null;
        $message = null;
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            $tr = Yii::$app->db->beginTransaction();
            try {
                $pid = $_POST['pid'];
                $ptn = new Patient();
                if ($pid != 0) {
                    $ptn = Patient::findOne($pid);
                }
                $ptn->attributes = $_POST['Patient'];
                $ptn->hospital_id = Yii::$app->user->identity->hospital_id;
                if ($ptn->validate()) {
                    $ptn->save();
                    $rid = $_POST['rid'];
                    $reg = new Registration();
                    if ($rid != 0) {
                        $reg = Registration::findOne($rid);
                    }
                    $reg->attributes = $_POST['Registration'];
                    $reg->hospital_id = $ptn->hospital_id;
                    $reg->patient_id = $ptn->patient_id;
                    $reg->mr_number = $ptn->mr_number;
                    $reg->regstts_id = Registration::Active;
                    $reg->date_in = date('Y-m-d');
                    $reg->time_in = date('H:i:s');
                    $reg->is_new_patient = $reg->setIsNewPatient();
                    $reg->is_new_unit = $reg->setIsNewUnit();
                    $reg->regsource_id = $reg->setRegsourceId();
                    $reg->reg_num = $reg->setNewRegNumber();
                    if ($reg->validate()) {
                        if (isset($_POST['RegistrationInpatient'])) {
                            $reg->is_inpatient = true;

                            $inp = new RegistrationInpatient();
                            $inp->attributes = $_POST['RegistrationInpatient'];
                            $inp->registration_id = $reg->registration_id;
                            $inp->is_active = true;
                            $inp->date_in = date('Y-m-d');
                            $inp->time_in = date('H:i:s');
                            if ($inp->validate()) {
                                $inp->save();
                                //set bed menjadi is_available = false dan isi last_used_by dengan registration_id
                                $bed = Bed::findOne($inp->bed_id);
                                $bed->is_available = false;
                                $bed->last_used_by = $inp->registration_id;
                                $bed->save();
                            } else {
                                $tr->rollBack();
                                $errors = $inp->errors;
                                $message = '<ol>';
                                foreach ($errors as $edx => $erow) {
                                    $message .= '<li>' . $erow[0] . '</li>';
                                }
                                $message .= '</ol>';
                                return [
                                    'code' => 404,
                                    'status' => 'failed',
                                    'message' => 'simpan data rawat inap gagal. ' . $message
                                ];
                            }
                        }
                        $reg->save();
                        $tr->commit();
                        return [
                            'code' => 200,
                            'status' => 'success',
                            'message' => 'pasien berhasil didaftarkan'
                        ];
                    } else {
                        $tr->rollBack();
                        $errors = $reg->errors;
                        $message = '<ol>';
                        foreach ($errors as $edx => $erow) {
                            $message .= '<li>' . $erow[0] . '</li>';
                        }
                        $message .= '</ol>';
                        return [
                            'code' => 404,
                            'status' => 'failed',
                            'message' => 'simpan data registrasi gagal. ' . $message
                        ];
                    }
                } else {
                    $tr->rollBack();
                    $errors = $ptn->errors;
                    $message = '<ol>';
                    foreach ($errors as $edx => $erow) {
                        $message .= '<li>' . $erow[0] . '</li>';
                    }
                    $message .= '</ol>';
                    return [
                        'code' => 404,
                        'status' => 'failed',
                        'message' => 'simpan data pasien gagal. ' . $message
                    ];
                }
            } catch (Exception $e) {
                $tr->rollBack();
                return ['code' => 500, 'message' => $e->getMessage()];
            }
            return ['status' => $status, 'code' => $code, 'message' => $message];
        }
    }

    public function actionCheckRegActive()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $pid = $_POST['pid'];
        $mdl = new Registration();
        $pidActive = $mdl->getPIDActive($pid);
        if (isset($pidActive)) {
            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'Pasien terdaftar pada ' . $pidActive->unit->unit_name . ' (' . $pidActive->doctor->fullname . ') tanggal ' . $pidActive->date_in . ' ' . $pidActive->time_in,
                'data' => $pidActive->attributes
            ];
        }
    }
}