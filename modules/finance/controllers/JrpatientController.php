<?php

namespace app\modules\finance\controllers;

use app\components\AppLogic;
use app\components\FinanceLogic;
use app\components\Formatter;
use app\models\JournalDetail;
use Yii;
use app\models\Journal;
use yii\db\Exception;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * JournalController implements the CRUD actions for Journal model.
 */
class JrpatientController extends Controller
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPosted()
    {
        $isposting = true;
        if (Yii::$app->request->isAjax) {
            return $this->getList($isposting);
        }
        return $this->render('list', ['isposting' => $isposting]);
    }

    public function actionUnposted()
    {
        $isposting = false;
        if (Yii::$app->request->isAjax) {
            return $this->getList($isposting);
        }
        return $this->render('list', ['isposting' => $isposting]);
    }

    public function actionPosting()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $trs = Yii::$app->db->beginTransaction();
            try {
                $post = $_POST['Journal'];
                $updateColumn = [
                    'is_posting' => true,
                    'posting_date' => date('Y-m-d', strtotime($post['posting_date'])),
                    'posting_time' => date('H:i:s'),
                    'posting_shift' => $post['posting_shift'],
                    'user_posting' => Yii::$app->user->getId(),
                    'updated_by' => Yii::$app->user->getId(),
                    'updated_time' => date('Y-m-d H:i:s')
                ];
                $updateCondition = ['in', 'journal_id', json_decode($post['jrid'])];
                $mdl = Journal::updateAll($updateColumn, $updateCondition);
                if ($mdl > 1) {
                    $trs->commit();
                    return ['code' => 200, 'status' => 'success', 'message' => 'Posting Berhasil'];
                } else {
                    $trs->rollBack();
                    return ['code' => 400, 'status' => 'failed', 'message' => 'tidak ada data yang di posting'];
                }
            } catch (\Exception $exception) {
                $trs->rollBack();
                return ['code' => 500, 'status' => 'error', 'message' => $exception->getTraceAsString()];
            }

        }
    }

    public function actionPostingform()
    {
        if (Yii::$app->request->isAjax) {
            try {
                $model = new Journal();
                $model->posting_date = date('d-m-Y');
                return $this->renderPartial('_postingForm', ['model' => $model, 'ids' => $_POST['rowId']]);
            } catch (Exception $e) {
                $message = AppLogic::Exceptionhtml($e);
                return ['code' => 500, 'status' => 'error', 'message' => $message];
            }
        }
    }

    public function getList($isposting)
    {
        $start = $_POST['start'];
        $length = ($_POST['length'] != -1 ? $_POST['length'] : null);
        $search = $_POST['search']['value'];
        $draw = $_POST['draw'];

        Yii::$app->response->format = Response::FORMAT_JSON;
        $journal = FinanceLogic::getJRList($search, $start, $length, $isposting);

        $data = [];
        $count = 0;
        $filtered = 0;
        $i = 0;
        if (!empty($journal['data'])) {
            $count = $journal['countAll'];
            $filtered = $journal['count'];
            if ($isposting) {
                foreach ($journal['data'] as $item) {
                    $data[$i][] = $i + 1;
                    $data[$i][] = $item['jr_num'];
                    $data[$i][] = $item['description'];
                    $data[$i][] = $item['entry_date'];
                    $data[$i][] = Formatter::formatNumber($item['nominal']);
                    $data[$i][] = $item['is_posting'];
                    $data[$i][] = $item['user_posting'];
                    $data[$i][] = $item['posting_date'];
                    $data[$i][] = $item['posting_shift'];
                    $data[$i][] = Html::a('<i class="fa fa-eye"></i>', 'javascript:void(0)', [
                        'class' => 'btn-sm btn-primary',
                        'data-bs-toggle' => 'modal',
                        'data-bs-target' => '#extralargemodal',
                        'onclick' => 'showDetail(' . $item['journal_id'] . ')'
                    ]);
                    $data[$i]['DT_RowId'] = $item['journal_id'];
                    $i++;
                }
            } else {
                foreach ($journal['data'] as $item) {
                    $data[$i][] = $i + 1;
                    $data[$i][] = $item['jr_num'];
                    $data[$i][] = $item['description'];
                    $data[$i][] = $item['entry_date'];
                    $data[$i][] = Formatter::formatNumber($item['nominal']);
                    $data[$i][] = $item['is_posting'];
                    $data[$i][] = Html::a('<i class="fa fa-eye"></i>', 'javascript:void(0)', [
                        'class' => 'btn-sm btn-primary',
                        'data-bs-toggle' => 'modal',
                        'data-bs-target' => '#extralargemodal',
                        'onclick' => 'showDetail(' . $item['journal_id'] . ')'
                    ]);
                    $data[$i]['DT_RowId'] = $item['journal_id'];
                    $i++;
                }
            }

        }
        $result = [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $filtered,
            'start' => $start,
            'length' => $length,
            'data' => $data
        ];
        return $result;
    }

    public function actionShowdetail()
    {
        if (Yii::$app->request->isAjax) {
            try {
                $jrid = $_POST['jrid'];
                $journal = Journal::findOne($jrid);
                $debet = JournalDetail::find()->where(['journal_id' => $jrid, 'type' => FinanceLogic::Debet, 'is_deleted' => false])->all();
                $credit = JournalDetail::find()->where(['journal_id' => $jrid, 'type' => FinanceLogic::Credit, 'is_deleted' => false])->all();
                return $this->renderPartial('_showDetail', ['journal' => $journal, 'debet' => $debet, 'credit' => $credit]);
            } catch (Exception $e) {
                return AppLogic::Exceptionhtml($e);
            }
        }
    }

    /**
     * Displays a single Journal model.
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
     * Creates a new Journal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Journal();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->journal_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Journal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->journal_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Journal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Journal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Journal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Journal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
