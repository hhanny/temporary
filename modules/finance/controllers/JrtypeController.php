<?php

namespace app\modules\finance\controllers;

use Yii;
use app\models\JournalType;
use app\models\JournalTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use app\models\ChartOfAccount;

/**
 * JrtypeController implements the CRUD actions for JournalType model.
 */
class JrtypeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all JournalType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JournalTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JournalType model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new JournalType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new JournalType();
        $model->hospital_id = Yii::$app->user->identity->hospital_id;
        $model->is_active = true;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->jtype_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing JournalType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->jtype_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing JournalType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->is_deleted = true;
        $model->deleted_by = Yii::$app->user->getId();
        $model->deleted_time = date('Y-m-d H:i:s');
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JournalType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JournalType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JournalType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionShowcoa()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            $key = $_POST['key'];
            if (empty($key)) {
                $key = '';
            }
            $datacount = ChartOfAccount::find()
                ->alias('t')
                ->where('lower(t.coa_name) like :p1 and t.is_active = true and t.is_deleted = false and t.hospital_id = :p2',
                    [':p1' => '%' . strtolower($key) . '%', ':p2' => Yii::$app->user->identity->hospital_id])
                ->count();

            $dataall = ChartOfAccount::find()
                ->alias('t')
                ->select(['t.coa_id', 't.coa_code', 't.coa_name'])
                ->where('lower(t.coa_name) like :p1 and t.is_active = true and t.is_deleted = false and t.hospital_id = :p2',
                    [':p1' => '%' . strtolower($key) . '%', ':p2' => Yii::$app->user->identity->hospital_id])
                ->all();

            if (!empty($dataall)) {
                foreach ($dataall as $ddx => $drow) {
                    $result['incomplete_results'] = false;
                    $result['total_count'] = $datacount;
                    $result['items'][$ddx]['id'] = $drow['coa_id'];
                    $result['items'][$ddx]['text'] = $drow['coa_code'] . '/' . $drow['coa_name'];
                }
            } else {
                $result['incomplete_results'] = false;
                $result['total_count'] = 0;
                $result['items'] = [];
            }
            return $result;
        }
    }
}
