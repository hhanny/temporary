<?php

namespace app\modules\finance\controllers;

use Yii;
use app\components\FinanceLogic;
use yii\db\Exception;

class ReportController extends \yii\web\Controller
{

    public function actionCshrincome()
    {
        return $this->render('income');
    }

    public function actionShowcshrincome()
    {
        if (Yii::$app->request->isAjax) {
            $tgl1 = date('Y-m-d', strtotime($_POST['tgl1']));
            $tgl2 = date('Y-m-d', strtotime($_POST['tgl2']));
            $shift = $_POST['shift'];

            $fin = new FinanceLogic();
            $param = [
                ':p1' => $fin->PP,
                ':p2' => $tgl1,
                ':p3' => $tgl2
            ];
            $qry = "WITH qry_debet as (SELECT jd.coa_id, jd.coa_code, jd.coa_name, jr.posting_date, jr.posting_shift, sum(nominal) as debet
                    FROM finance.journal_detail jd
                    inner join finance.journal jr on jr.journal_id=jd.journal_id
                    inner join finance.journal_type jt on jt.jtype_id=jr.jtype_id and jt.debet_coa_id=jd.coa_id
                    where jr.jrgroup_id = :p1 and jd.is_deleted = FALSE and jr.is_posting = true and jd.type = 'D' and jr.posting_date between :p2 and :p3
                    GROUP BY jd.coa_id, jd.coa_code, jd.coa_name, jd.type, jr.posting_date,  jr.posting_shift
                    ), qry_credit as (
                    SELECT jd.coa_id, jd.coa_code, jd.coa_name, jr.posting_date, jr.posting_shift, COALESCE(sum(nominal),0) as credit
                    FROM finance.journal_detail jd
                    inner join finance.journal jr on jr.journal_id=jd.journal_id
                    inner join finance.journal_type jt on jt.jtype_id=jr.jtype_id and jt.debet_coa_id=jd.coa_id
                    where jr.jrgroup_id = :p1 and jd.is_deleted = FALSE and jr.is_posting = true and jd.type = 'C' and jr.posting_date between :p2 and :p3
                    GROUP BY jd.coa_id, jd.coa_code, jd.coa_name, jr.posting_date,  jr.posting_shift
                    )
                    SELECT q1.coa_code, q1.coa_name, to_char(q1.posting_date, 'dd-mm-yyyy') as posting_date, q1.posting_shift, COALESCE(q2.credit,0) as credit, (q1.debet - COALESCE(q2.credit,0)) as nominal from qry_debet q1 
                    left join qry_credit q2 on q1.coa_id=q2.coa_id 
                    and q1.coa_code=q2.coa_code 
                    and q1.coa_name=q2.coa_name 
                    and q1.posting_date=q2.posting_date 
                    and q1.posting_shift=q2.posting_shift
                    ";
            if ($shift != "-1") {
                $qry .= " where q1.posting_shift = :p4";
                $param[':p4'] = $shift;
            }

            $qry .= " order by q1.coa_code asc";
            $data = Yii::$app->db->createCommand($qry);
            $data->bindValues($param);
            $model = $data->queryAll();
            return $this->renderPartial('_showincome', ['model' => $model]);
        }
    }
}
