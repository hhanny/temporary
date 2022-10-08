<?php

namespace app\components;

use app\models\Billing;
use app\models\ChartOfAccount;
use app\models\JournalDetail;
use app\models\JournalGroup;
use app\models\JournalType;
use app\models\Payment;
use app\models\Registration;
use mdm\admin\models\form\Login;
use phpDocumentor\Reflection\Types\This;
use Yii;
use app\models\Journal;

class FinanceLogic
{
    public $UM = '01'; //jurnal umum
    public $PP = '02'; //jurnal pembayaran pasien
    public $RJ = '03'; //jurnal rawat jalan
    public $RD = '04'; //jurnal rawat darurat
    public $RI = '05'; //jurnal rawat inap
    public $BP = '06'; //jurnal pembayaran piutang bpjs
    public $NB = '07'; //jurnal pembayaran piutang non bpjs

    const Debet = 'D';
    const Credit = 'C';

    public function createJRCheckoutPatient($reg)
    {
        $mdl = new Journal();
        $mdl->hospital_id = $reg->hospital_id;
        $mdl->registration_id = $reg->registration_id;
        $jtype = $this->getType($reg);
        $mdl->jrgroup_id = $jtype->jrgroup_id;
        $mdl->jtype_id = $jtype->jtype_id;
        $mdl->jr_num = $this->getJrNum($mdl->hospital_id, $jtype);
        $mdl->description = $jtype->jrgroup->acc_label . ' ' . $reg->reg_num . '/' . $reg->patient->fullname;
        $mdl->entry_date = date('Y-m-d');
        if ($mdl->save()) {
            /*
             * debet row
             */
            $message = null;
            $err1 = false;

            $sql = 'select sum(nominal) from payment where registration_id = :p1 and is_deleted = :p2';
            $sumPayment = Yii::$app->db->createCommand($sql);
            $sumPayment->bindValues([':p1' => $mdl->registration_id, ':p2' => false]);
            $dNominal = $sumPayment->queryScalar();

            $jrd = new JournalDetail();
            $jrd->journal_id = $mdl->journal_id;
            $jrd->description = $jtype->debet_coa_name;
            $jrd->coa_id = $jtype->debet_coa_id;
            $jrd->coa_code = $jtype->debet_coa_code;
            $jrd->coa_name = $jtype->debet_coa_name;
            $jrd->type = self::Debet;
            $jrd->nominal = $dNominal;
            $jrd->debet_nominal = $jrd->nominal;
            $jrd->credit_nominal = 0;
            if (!$jrd->save()) {
                $errors = $jrd->errors;
                foreach ($errors as $edx => $erow) {
                    $message .= '<li>' . $erow[0] . '</li>';
                }
                $err1 = true;
            }
            if ($err1) {
                $msg = '<ol>';
                $msg .= $message;
                $msg .= '</ol';
                return ['code' => 400, 'status' => 'error1', 'message' => $msg, 'errType' => 'save journal credit'];
            }
            // kredit row
            $err2 = false;
            $billing = Billing::find()->where(['registration_id' => $reg->registration_id, 'is_deleted' => false])->all();
            foreach ($billing as $xb) {
                $jrc = new JournalDetail();
                $jrc->journal_id = $mdl->journal_id;
                $jrc->description = $xb->prdrate->product->name;
                $jrc->coa_id = $xb->prdrate->product->coa_id;
                $jrc->coa_code = $xb->prdrate->product->coa->coa_code;
                $jrc->coa_name = $xb->prdrate->product->coa->coa_name;
                $jrc->type = self::Credit;
                $jrc->nominal = Formatter::unformatNumber($xb->total);
                $jrc->debet_nominal = 0;
                $jrc->credit_nominal = $jrc->nominal;
                if ($jrc->validate()) {
                    $jrc->save();
                } else {
                    $errors = $jrc->errors;
                    foreach ($errors as $edx => $erow) {
                        $message .= '<li>' . $erow[0] . '</li>';
                    }
                    $err2 = true;
                }
            }
            if ($err2) {
                $msg = '<ol>';
                $msg .= $message;
                $msg .= '</ol';
                return ['code' => 400, 'status' => 'error2', 'message' => $msg, 'errType' => 'save journal credit'];
            }
            return ['code' => 200, 'status' => 'success', 'message' => 'Journal Berhasil Dibuat', 'journal' => $mdl];
        } else {
            $errors = $mdl->errors;
            $message = '<ol>';
            foreach ($errors as $edx => $erow) {
                $message .= '<li>' . $erow[0] . '</li>';
            }
            $message .= '</ol>';
            return ['code' => 400, 'status' => 'failed', 'message' => $message];
        }
    }

    public function createJRPaymentPatient($reg, $payment)
    {
        $mdl = new Journal();
        $mdl->hospital_id = $reg->hospital_id;
        $mdl->registration_id = $reg->registration_id;
        $mdl->jrgroup_id = $payment->paytype->jtype->jrgroup_id;
        $mdl->jtype_id = $payment->paytype->jtype_id;
        $mdl->jr_num = $this->getJrNum($mdl->hospital_id, $payment->paytype->jtype);
        $mdl->description = $payment->paytype->jtype->jrgroup->acc_label . ' ' . $reg->reg_num . '/' . $reg->patient->fullname;
        $mdl->entry_date = date('Y-m-d');
        $mdl->payment_id = $payment->payment_id;
        if ($mdl->save()) {
            /*
             * create journal detil debet
             */
            $jrtype = $payment->paytype->jtype;
            $jrd = new JournalDetail();
            $jrd->journal_id = $mdl->journal_id;
            $jrd->description = $payment->paytype->name . '/' . $payment->description;
            $jrd->coa_id = $jrtype->debet_coa_id;
            $jrd->coa_code = $jrtype->debet_coa_code;
            $jrd->coa_name = $jrtype->debet_coa_name;
            $jrd->type = self::Debet;
            $jrd->nominal = $payment->nominal;
            $jrd->debet_nominal = $jrd->nominal;
            $jrd->credit_nominal = 0;
            if (!$jrd->save()) {
                $errors = $jrd->errors;
                $message = '<ol>';
                foreach ($errors as $edx => $erow) {
                    $message .= '<li>' . $erow[0] . '</li>';
                }
                $message .= '</ol>';
                return ['code' => 400, 'status' => 'failed', 'message' => $message];
            }

            /*
             * create journal detail credit
             */
            $jrc = new JournalDetail();
            $jrc->journal_id = $mdl->journal_id;
            $jrc->coa_id = $jrtype->credit_coa_id;
            $jrc->description = $payment->paytype->name . '/' . $payment->description;
            $jrc->coa_code = $jrtype->credit_coa_code;
            $jrc->coa_name = $jrtype->credit_coa_name;
            $jrc->type = self::Credit;
            $jrc->nominal = $payment->nominal;
            $jrc->credit_nominal = $jrc->nominal;
            $jrc->debet_nominal = 0;
            if (!$jrc->save()) {
                $errors = $jrd->errors;
                $message = '<ol>';
                foreach ($errors as $edx => $erow) {
                    $message .= '<li>' . $erow[0] . '</li>';
                }
                $message .= '</ol>';
                return ['code' => 400, 'status' => 'failed', 'message' => $message];
            }
            return ['code' => 200, 'status' => 'success', 'message' => 'Journal Pembayaran Berhasil Dibuat', 'journal' => $mdl];
        } else {
            $errors = $mdl->errors;
            $message = '<ol>';
            foreach ($errors as $edx => $erow) {
                $message .= '<li>' . $erow[0] . '</li>';
            }
            $message .= '</ol>';
            return ['code' => 400, 'status' => 'failed', 'message' => $message];
        }
    }

    public function getJrNum($hosID, $type)
    {
        $sql = 'select max(jr_num) from finance.journal where hospital_id = :p1 and jtype_id = :p2 and extract(year from created_time) = :p3 and extract(month from created_time) = :p4';
        $qry = Yii::$app->db->createCommand($sql);
        $qry->bindValues([':p1' => $hosID, ':p2' => $type->jtype_id, ':p3' => date('Y'), ':p4' => date('m')]);
        $maxjrnum = $qry->queryScalar();
        $jrnum = explode('-', $maxjrnum);
        $num = (int)$jrnum[2] + 1;
        return $type->code . '-' . date('ym') . '-' . str_pad($num, 5, '0', STR_PAD_LEFT);
    }

    public function getCoaById($id)
    {
        return ChartOfAccount::findOne($id);
    }

    public function getType($reg)
    {
        $group = null;
        if ($reg->is_inpatient) {
            $group = $this->RI;
        } else {
            if ($reg->unit->unitgroup_id == Registration::UG_RJL) {
                $group = $this->RJ;
            } elseif ($reg->unit->unitgroup_id == Registration::UG_IGD) {
                $group = $this->RD;
            }
        }
        return JournalType::find()->where(['jrgroup_id' => $group, 'hospital_id' => $reg->hospital_id])->one();
    }

    public static function getJRList($search, $start, $length, $isposting)
    {
        $param = [
            ':p1' => 'D',
            ':p2' => $isposting,
            ':p3' => Yii::$app->user->identity->hospital_id,
            ':p4' => false
        ];

        $sql1 = "select jr.journal_id, jr.jr_num, jr.description, to_char(jr.entry_date, 'dd-mm-yyyy') as entry_date, jrdetail.nominal, jr.is_posting, e.person_name as user_posting, 
                to_char(jr.posting_date, 'dd-mm-yyyy') || ' ' || to_char(jr.posting_time, 'HH24:MI') as posting_date, jr.posting_shift from finance.journal jr
                join LATERAL (
                    select jd.journal_id, sum(jd.nominal) as nominal from finance.journal_detail jd where jd.journal_id=jr.journal_id and jd.type = :p1  GROUP BY jd.journal_id
                ) as jrdetail on jr.journal_id=jrdetail.journal_id 
                left join public.users u on jr.user_posting=u.user_id
                left join public.employee e on u.person_id=e.person_id
                where jr.is_posting = :p2 and jr.hospital_id = :p3 and jr.is_deleted = :p4";
        $query1 = Yii::$app->db->createCommand($sql1);
        $query1->bindValues($param);

        $sql2 = 'select count(*) from finance.journal jr
                join LATERAL (
                    select jd.journal_id, sum(jd.nominal) as nominal from finance.journal_detail jd where jd.journal_id=jr.journal_id and jd.type = :p1  GROUP BY jd.journal_id
                ) as jrdetail on jr.journal_id=jrdetail.journal_id 
                left join public.users u on jr.user_posting=u.user_id
                left join public.employee e on u.person_id=e.person_id
                where jr.is_posting = :p2 and jr.hospital_id = :p3 and jr.is_deleted = :p4';
        $query2 = Yii::$app->db->createCommand($sql2);
        $query2->bindValues($param);

        // total record tanpa filter
        $countAll = $query2->queryScalar();

        $cparam = $param;

        if (!empty($search)) {
            $sql1 .= ' and (lower(jr.jr_num) like :s1 or lower(jr.description) like :s2)';
            $sql2 .= ' and (lower(jr.jr_num) like :s1 or lower(jr.description) like :s2)';

            $param[':s1'] = '%' . strtolower($search) . '%';
            $param[':s2'] = '%' . strtolower($search) . '%';

            $cparam[':s1'] = '%' . strtolower($search) . '%';
            $cparam[':s2'] = '%' . strtolower($search) . '%';
        }

        $sql1 .= ' order by jr.entry_date desc limit :p5 offset :p6';
        $query1 = Yii::$app->db->createCommand($sql1);
        $param[':p5'] = $length;
        $param[':p6'] = $start;
        $query1->bindValues($param);

        $data = $query1->queryAll();

        // total record dengan filter
        $query2 = Yii::$app->db->createCommand($sql2);
        $query2->bindValues($cparam);

        $count = $query2->queryScalar();

        return ['data' => $data, 'count' => $count, 'countAll' => $countAll];
    }
}