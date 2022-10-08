<?php


namespace app\modules\apisrv\controllers\v1;

use Yii;
use app\components\Apisrv1Controller;
use yii\web\Response;
use PDO;

class CoaController extends Apisrv1Controller
{
    public function actionGetlist()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            $key = '%' . strtolower($_GET['key']) . '%';
            $hID = (int)$_GET['hID'];
            if (empty($key)) {
                $key = '';
            }
            $sql1 = "select count(*) from chart_of_account
                    where lower(concat_ws('/',coa_code, coa_name)) like :p1 and hospital_id = :p2";
            $qry1 = Yii::$app->db->createCommand($sql1);
            $qry1->bindParam(':p1', $key, PDO::PARAM_STR);
            $qry1->bindParam(':p2', $hID, PDO::PARAM_INT);
            $datacount = $qry1->queryScalar();

            $sql2 = "select coa_id, concat_ws('/',coa_code, coa_name) as coa_name from chart_of_account
                    where lower(concat_ws('/',coa_code, coa_name)) like :p1 and hospital_id = :p2";
            $qry2 = Yii::$app->db->createCommand($sql2);
            $qry2->bindParam(':p1', $key, PDO::PARAM_STR);
            $qry2->bindParam(':p2', $hID, PDO::PARAM_INT);
            $dataall = $qry2->queryAll();

            if (!empty($dataall)) {
                foreach ($dataall as $ddx => $drow) {
                    $result['incomplete_results'] = false;
                    $result['total_count'] = $datacount;
                    $result['items'][$ddx]['id'] = $drow['coa_id'];
                    $result['items'][$ddx]['text'] = $drow['coa_name'];
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