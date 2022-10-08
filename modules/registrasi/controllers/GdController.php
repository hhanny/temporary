<?php

namespace app\modules\registrasi\controllers;

use Yii;
use app\models\Patient;
use app\models\Registration;
use yii\web\NotFoundHttpException;

class GdController extends \yii\web\Controller
{
    public function actionNewreg()
    {
        if (Yii::$app->request->get('id')) {
            $patient_id = Yii::$app->request->get('id');
        }
        $mdl1 = new Patient();
        $mdl1->mr_number = Patient::getNoRm();
        if (isset($patient_id)) {
            $mdl1 = Patient::findOne($patient_id);
        }

        $mdl2 = new Registration();
        $mdl2->unit_id = $mdl2->getIGDCode()->unit_id;
        $pidActive = $mdl2->getPIDActive($patient_id);
        if (isset($pidActive)) {
            throw new NotFoundHttpException(Yii::t('app', 'Pasien tidak dapat didaftarkan, karena terdaftar pada ' . $pidActive->unit->unit_name . '(' . $pidActive->doctor->fullname . ') tanggal ' . $pidActive->date_in . ' ' . $pidActive->time_in));
        }
        $mdl2->pic_name = '-';
        $mdl2->pic_address = '-';
        $mdl2->pic_phone = '-';

        return $this->render('/main/newreg', [
            'mdl1' => $mdl1,
            'mdl2' => $mdl2
        ]);
    }

}
