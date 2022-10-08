<?php

namespace app\modules\registrasi\controllers;

use app\models\Unit;
use Yii;
use app\models\Patient;
use app\models\Registration;
use app\models\RegistrationSearch;
use yii\web\NotFoundHttpException;

class RjController extends \yii\web\Controller
{
    /**
     * Lists all Registration models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RegistrationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, Unit::UC_RJ);

        return $this->render('/main/list_reg', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

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
