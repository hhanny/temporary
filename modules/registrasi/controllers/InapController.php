<?php

namespace app\modules\registrasi\controllers;

use app\models\RegistrationInpatient;
use app\models\RegistrationInpatientSearch;
use app\models\RegistrationSearch;
use app\models\Unit;
use Yii;
use app\models\Patient;
use app\models\Registration;
use yii\web\NotFoundHttpException;

class InapController extends \yii\web\Controller
{
    public function actionPactive()
    {
        $searchModel = new RegistrationInpatientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionNew($rID)
    {
        $mdl2 = Registration::findOne($rID);

        $mdl1 = Patient::findOne($mdl2->patient_id);
        $pidActive = $mdl2->getPIDActiveInap($mdl2->patient_id);
        if (isset($pidActive)) {
            throw new NotFoundHttpException(Yii::t('app', 'Pasien tidak dapat didaftarkan, karena terdaftar pada ' . $pidActive->unit->unit_name . '(' . $pidActive->doctor->fullname . ') tanggal ' . $pidActive->date_in . ' ' . $pidActive->time_in));
        }

        $mdl3 = new RegistrationInpatient();

        return $this->render('/main/newreg', [
            'mdl1' => $mdl1,
            'mdl2' => $mdl2,
            'mdl3' => $mdl3
        ]);
    }

}
