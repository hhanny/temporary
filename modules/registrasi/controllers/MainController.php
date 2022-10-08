<?php

namespace app\modules\registrasi\controllers;

use app\models\PatientSearch;
use app\models\Registration;
use app\models\RegistrationSearch;
use app\models\Unit;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Response;
use PDO;

class MainController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className()
            ],
        ];
    }

    /**
     * Lists all Patient models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PatientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPatactive()
    {
        $searchModel = new RegistrationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post(), false, Registration::Active);

        return $this->render('/main/list_reg', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
