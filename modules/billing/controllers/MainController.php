<?php

namespace app\modules\billing\controllers;

use app\components\FinanceLogic;
use app\models\Journal;
use app\models\JournalDetail;
use Yii;
use app\components\AppLogic;
use app\components\BillingLogic;
use app\components\Formatter;
use app\models\Bed;
use app\models\Billing;
use app\models\ClassRoom;
use app\models\Payment;
use app\models\ProductRate;
use app\models\Registration;
use app\models\RegistrationInpatient;
use app\models\UnitGroup;
use app\models\RegistrationSearch;
use yii\db\Exception;
use yii\helpers\Html;
use yii\web\Response;

class MainController extends \yii\web\Controller
{
    public function actionRin()
    {
        $title = 'Informasi Pasien Rawat Inap';
        $history = false;
        $searchModel = new RegistrationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, true, Registration::Active);

        return $this->render('rin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => $title,
            'history' => $history
        ]);
    }

    public function actionFormpayment()
    {
        $reg = Registration::findOne($_POST['rid']);
        $model = new Payment();
        return $this->renderPartial('_formpayment', ['reg' => $reg, 'model' => $model]);
    }

    public function actionSavepayment()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            $db = Yii::$app->db->beginTransaction();
            try {
                $model = new Payment();
                $model->paytype_id = $_POST['Payment']['paytype_id'];
                $model->registration_id = $_POST['rid'];
                $model->nominal = Formatter::unformatNumber($_POST['Payment']['nominal']);
                $model->description = $_POST['Payment']['description'];
                $model->hospital_id = Yii::$app->user->identity->hospital_id;
                $model->is_patient = true;
                $model->created_by = Yii::$app->user->getId();
                $model->created_time = date('Y-m-d H:i:s');
                $model->is_deleted = false;
                if ($model->validate()) {
                    $model->save();
                    /*
                     * create jurnal
                     */
                    $reg = Registration::findOne($model->registration_id);

                    $fin = new FinanceLogic();
                    $dfin = $fin->createJRPaymentPatient($reg, $model);
                    if ($dfin['code'] == 200) {
                        $upPayment = Payment::findOne($model->payment_id);
                        $upPayment->journal_id = $dfin['journal']->journal_id;
                        $upPayment->save();
                        $db->commit();
                        $diskon = BillingLogic::getDiskon($model->registration_id);
                        $tagihan = BillingLogic::getTagihan($model->registration_id);
                        $jmlbayar = BillingLogic::getJmlBayar($model->registration_id);
                        $sisabayar = BillingLogic::getSisaBayar($model->registration_id);
                        return ['code' => 200, 'status' => 'success', 'message' => 'simpan payment berhasil', 'jmlbayar' => Formatter::formatNumber($jmlbayar), 'diskon' => Formatter::formatNumber($diskon), 'tagihan' => Formatter::formatNumber($tagihan), 'sisabayar' => Formatter::formatNumber($sisabayar)];
                    } else {
                        $db->rollBack();
                        return $dfin;
                    }

                } else {
                    $db->rollBack();
                    $errors = $model->errors;
                    $message = '<ol>';
                    foreach ($errors as $edx => $erow) {
                        $message .= '<li>' . $erow[0] . '</li>';
                    }
                    $message .= '</ol>';
                    return ['code' => 400, 'status' => 'failed', 'message' => $message];
                }
            } catch (Exception $e) {
                $db->rollBack();
                return AppLogic::Exceptionhtml($e->getTraceAsString());
            }
        }
    }

    public function actionRjligd()
    {
        $title = 'Informasi Pasien Rawat Jalan & IGD';
        $searchModel = new RegistrationSearch();
        $history = false;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, false, Registration::Active);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => $title,
            'history' => $history
        ]);
    }

    public function actionView($id)
    {
        $model = Registration::findOne($id);
        $unitgr = UnitGroup::find()->getPoli()->all();

        foreach ($unitgr as $item) {
            if (Yii::$app->authManager->checkAccess(Yii::$app->user->getId(), $item->unitgroup_id)) {
                if (in_array($item->unitgroup_id, UnitGroup::getMustInPatient())) {
                    if ($model->is_inpatient) {
                        $tabMenu[] = $item->unitgroup_id;
                    } else {
                        continue;
                    }
                } else {
                    $tabMenu[] = $item->unitgroup_id;
                }
            }
        }

        return $this->render('view', [
            'model' => $model,
            'unitgr' => $unitgr,
            'rID' => $model->registration_id,
            'roles' => array_values($tabMenu),
            'firstKey' => $tabMenu[0]
        ]);
    }

    public function actionShowdetail()
    {
        if (Yii::$app->request->isAjax) {
            try {
                $rid = $_POST['rid'];
                $reg = Registration::findOne($rid);
                $regIn = RegistrationInpatient::getActive($rid);
                if (!empty($regIn)) {
                    $class_id = $regIn->class_id;
                } else {
                    $classRoom = ClassRoom::find()->isGeneral()->one();
                    $class_id = $classRoom->class_id;
                }

                $mug = UnitGroup::findOne($_POST['ugid']);
                $model = new Billing();
                return $this->renderPartial('detail', ['reg' => $reg, 'rid' => $rid, 'ugid' => $mug->unitgroup_id, 'mug' => $mug, 'model' => $model, 'class_id' => $class_id]);
            } catch (Exception $e) {
                return AppLogic::Exceptionhtml($e);
            }
        }
    }

    public function actionListbyug()
    {
        $rid = $_POST['rid'];
        $ugid = $_POST['ugid'];
        $start = $_POST['start'];
        $length = $_POST['length'];
        $search = $_POST['search']['value'];
        $draw = $_POST['draw'];

        Yii::$app->response->format = Response::FORMAT_JSON;
        $reg = Registration::findOne($rid);
        $billing = BillingLogic::getListByUGID($rid, $ugid, $search, $start, $length);

        $data = [];
        $count = 0;
        $filtered = false;
        $i = 0;
        if (!empty($billing['data'])) {
            $count = $billing['countAll'];
            $filtered = $billing['count'];
            foreach ($billing['data'] as $item) {
                $data[$i][] = $i + 1;
                $data[$i][] = $item->prdrate->product_id;
                $data[$i][] = $item->prdrate->product->name;
                $data[$i][] = $item->prdrate->product->coa->coa_code;
                $data[$i][] = $item->nominal;
                $data[$i][] = $item->volume;
                $data[$i][] = $item->total;
                $data[$i][] = $item->createdBy->username;
                $data[$i][] = $item->created_time;
                if ($reg->regstts_id == Registration::Active) {
                    $data[$i][] = Html::a('<i class="fa fa-trash"></i>', 'javascript:void(0)', [
                        'class' => 'btn btn-sm btn-icon btn-danger',
                        'onclick' => 'delBilling(' . $item->billing_id . ')'
                    ]);
                }
                $i++;
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

    public function actionShowproduk()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            $key = $_POST['key'];
            if (empty($key)) {
                $key = '';
            }
            $datacount = ProductRate::find()
                ->alias('t')
                ->innerJoin('product p', 'p.product_id=t.product_id')
                ->innerJoin('class_room c', 't.class_id=c.class_id')
                ->where('lower(p.name) like :p1 and t.is_active = true and t.is_deleted = false and t.hospital_id = :p2 and p.unitgroup_id = :p3 and t.class_id = :p4 and p.coa_id is not null',
                    [':p1' => '%' . strtolower($key) . '%', ':p2' => Yii::$app->user->identity->hospital_id, ':p3' => $_POST['ugid'], ':p4' => $_POST['class_id']])
                ->count();

            $dataall = ProductRate::find()
                ->alias('t')
                ->innerJoin('product p', 'p.product_id=t.product_id')
                ->innerJoin('class_room c', 't.class_id=c.class_id')
                ->select(['t.prdrate_id', 'p.name', 'c.class_name'])
                ->where('lower(p.name) like :p1 and t.is_active = true and t.is_deleted = false and t.hospital_id = :p2 and p.unitgroup_id = :p3 and t.class_id = :p4 and p.coa_id is not null',
                    [':p1' => '%' . strtolower($key) . '%', ':p2' => Yii::$app->user->identity->hospital_id, ':p3' => $_POST['ugid'], ':p4' => $_POST['class_id']])
                ->all();

            if (!empty($dataall)) {
                foreach ($dataall as $ddx => $drow) {
                    $result['incomplete_results'] = false;
                    $result['total_count'] = $datacount;
                    $result['items'][$ddx]['id'] = $drow['prdrate_id'];
                    $result['items'][$ddx]['text'] = $drow['name'] . '/' . $drow['class_name'];
                }
            } else {
                $result['incomplete_results'] = false;
                $result['total_count'] = 0;
                $result['items'] = [];
            }
            return $result;
        }
    }

    public function actionGetprdratebyid()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $idx = $_POST['id'];
        $mdl1 = ProductRate::findOne($idx);
        return ['status' => 'success', 'message' => 'data ditemukan', 'result' => ['id' => $idx, 'name' => $mdl1->product->name, 'nominal' => Formatter::formatNumber($mdl1->nominal)]];
    }

    public function actionSave()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $db = Yii::$app->db->beginTransaction();
        try {
            if (!empty($_POST)) {
                $rowData = [];
                $countData = count($_POST['prdrate_id']);
                for ($i = 0; $i < $countData; $i++) {
                    $rowData[] = [
                        Yii::$app->user->identity->hospital_id, $_POST['rid'], $_POST['prdrate_id'][$i], true, Formatter::unformatNumber($_POST['nominal'][$i]), Formatter::unformatNumber($_POST['volume'][$i]), Formatter::unformatNumber($_POST['total'][$i]), $_POST['ugid'], Yii::$app->user->getId(), date('Y-m-d H:i:s')
                    ];
                }
                $exec = Yii::$app->db->createCommand()->batchInsert(Billing::tableName(),
                    ['hospital_id', 'registration_id', 'prdrate_id', 'is_patient', 'nominal', 'volume', 'total', 'unitgroup_id', 'created_by', 'created_time'],
                    $rowData
                )->execute();
                if ($exec > 0) {
                    $db->commit();
                    $biaya = BillingLogic::getBiaya($_POST['rid']);
                    $diskon = BillingLogic::getDiskon($_POST['rid']);
                    $tagihan = BillingLogic::getTagihan($_POST['rid']);
                    $sisabayar = BillingLogic::getSisaBayar($_POST['rid']);
                    $result = ['code' => 200, 'status' => 'success', 'biaya' => Formatter::formatNumber($biaya), 'diskon' => Formatter::formatNumber($diskon), 'tagihan' => Formatter::formatNumber($tagihan), 'sisabayar' => Formatter::formatNumber($sisabayar)];
                } else {
                    $db->rollBack();
                    $result = ['code' => 500, 'status' => 'failed', 'message' => 'Data gagal disimpan'];
                }
                return $result;
            }
        } catch (Exception $e) {
            $db->rollBack();
            return AppLogic::Exceptionhtml($e);
        }
    }

    public function actionDelete()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $db = Yii::$app->db->beginTransaction();
        try {
            $model = Billing::findOne($_POST['id']);
            $model->is_deleted = true;
            $model->deleted_by = Yii::$app->user->getId();
            $model->deleted_time = date('Y-m-d H:i:s');
            if ($model->save()) {
                $biaya = BillingLogic::getBiaya($model->registration_id);
                $diskon = BillingLogic::getDiskon($model->registration_id);
                $tagihan = BillingLogic::getTagihan($model->registration_id);
                $db->commit();
                $result = ['code' => 200, 'status' => 'success', 'biaya' => Formatter::formatNumber($biaya), 'diskon' => Formatter::formatNumber($diskon), 'tagihan' => Formatter::formatNumber($tagihan)];
            } else {
                $db->rollBack();
                $errors = $model->errors;
                $message = '<ol>';
                foreach ($errors as $edx => $erow) {
                    $message .= '<li>' . $erow[0] . '</li>';
                }
                $message .= '</ol>';
                $result = ['code' => 500, 'status' => 'failed', 'message' => $message];
            }
        } catch (\Exception $e) {
            $db->rollBack();
            return AppLogic::Exceptionhtml($e->getTraceAsString());
        }
        return $result;
    }

    public function actionShowpayment()
    {
        $model = Payment::find()->where(['registration_id' => $_POST['rid']])->active()->all();
        $reg = Registration::findOne($_POST['rid']);
        return $this->renderPartial('_showpayment', ['model' => $model, 'reg' => $reg]);
    }

    public function actionDelpayment()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            $db = Yii::$app->db->beginTransaction();
            try {
                $model = Payment::findOne($_POST['payid']);
                /*
                 * check jurnal apakah sudah diposting atau belum
                 */
                if ($model->journal->is_posting) {
                    return ['code' => 400, 'status' => 'failed', 'message' => 'Journal dengan nomor ' . $model->journal->jr_num . ' telah diposting, delete pembayaran tidak dapat dilakukan'];
                }
                $model->is_deleted = true;
                $model->deleted_by = Yii::$app->user->getId();
                $model->deleted_time = date('Y-m-d H:i:s');

                $jrnl = Journal::findOne($model->journal_id);
                $jrnl->is_deleted = true;
                $jrnl->deleted_by = Yii::$app->user->getId();
                $jrnl->deleted_time = date('Y-m-d H:i:s');
                if ($model->save() && $jrnl->save()) {
                    // hapus jurnal detail
                    JournalDetail::updateAll(
                        ['is_deleted' => true, 'deleted_by' => Yii::$app->user->getId(), 'deleted_time' => date('Y-m-d H:i:s')],
                        ['journal_id' => $model->journal_id]
                    );

                    $db->commit();
                    $diskon = BillingLogic::getDiskon($model->registration_id);
                    $tagihan = BillingLogic::getTagihan($model->registration_id);
                    $jmlbayar = BillingLogic::getJmlBayar($model->registration_id);
                    return ['code' => 200, 'status' => 'success', 'message' => 'Delete Payment ' . $model->payment_id . ' berhasil', 'jmlbayar' => Formatter::formatNumber($jmlbayar), 'diskon' => Formatter::formatNumber($diskon), 'tagihan' => Formatter::formatNumber($tagihan)];
                } else {
                    $db->rollBack();
                    $errors = $model->errors;
                    $message = '<ol>';
                    foreach ($errors as $edx => $erow) {
                        $message .= '<li>' . $erow[0] . '</li>';
                    }
                    $message .= '</ol>';
                    return ['code' => 500, 'status' => 'failed', 'message' => $message];
                }
            } catch (Exception $e) {
                $db->rollBack();
                return AppLogic::Exceptionhtml($e->getTraceAsString());
            }
        }
    }

    public function actionCheckout()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            $db = Yii::$app->db->beginTransaction();
            try {
                $model = Registration::findOne($_POST['rid']);
                $model->regstts_id = Registration::NonActive;
                $model->date_out = date('Y-m-d');
                $model->time_out = date('H:i:s');

                $tagihan = BillingLogic::getTagihan($model->registration_id);
                $jmlbayar = BillingLogic::getJmlBayar($model->registration_id);

                if ($tagihan != $jmlbayar) {
                    return ['code' => 400, 'status' => 'failed', 'message' => 'tagihan (' . Formatter::formatNumber($tagihan) . ' dan jumlah bayar ' . Formatter::formatNumber($jmlbayar) . ') tidak balance'];
                }

                $fin = new FinanceLogic();
                $dfin = $fin->createJRCheckoutPatient($model);
                if ($model->save()) {
                    if ($model->is_inpatient) {
                        $inp = RegistrationInpatient::getActive($model->registration_id);
                        $rein = RegistrationInpatient::findOne($inp->inpatien_id);
                        $rein->date_out = $model->date_out;
                        $rein->time_out = $model->time_out;
                        $rein->is_active = false;
                        $rein->save();

                        $bed = Bed::findOne($rein->bed_id);
                        $bed->last_used_by = null;
                        $bed->save();
                    }
                    if ($dfin['code'] != 200) {
                        return ['code' => 400, 'status' => 'failed', 'message' => $dfin['message'], 'errType' => $dfin['errType']];
                    }
                    $db->commit();
                    return ['code' => 200, 'status' => 'success', 'message' => 'Checkout Pasien ' . $model->reg_num . ' a/n ' . $model->patient->fullname];

                } else {
                    $db->rollBack();
                    $errors = $model->errors;
                    $message = '<ol>';
                    foreach ($errors as $edx => $erow) {
                        $message .= '<li>' . $erow[0] . '</li>';
                    }
                    $message .= '</ol>';
                    return ['code' => 400, 'status' => 'failed', 'message' => $message];
                }
            } catch (\Exception $e) {
                $db->rollBack();
                return ['code' => 500, 'status' => 'error', 'message' => $e->getTraceAsString()];
            }
        }
    }

    public function actionHstrrjligd()
    {
        $title = 'History Pasien Rawat Jalan & IGD';
        $history = true;
        $searchModel = new RegistrationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, false);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => $title,
            'history' => $history
        ]);
    }

    public function actionHstrrin()
    {
        $title = 'History Pasien Rawat Inap';
        $history = true;
        $searchModel = new RegistrationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, true);

        return $this->render('rin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => $title,
            'history' => $history
        ]);

    }

}
