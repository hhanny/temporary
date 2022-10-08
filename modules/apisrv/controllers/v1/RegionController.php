<?php

namespace app\modules\apisrv\controllers\v1;

use Yii;
use yii\web\Response;

use PDO;

class RegionController extends \yii\web\Controller
{
    public function actionGetlist()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            $key = '%' . strtolower($_POST['key']) . '%';
            if (empty($key)) {
                $key = '';
            }
            $sql1 = "select count(*) from subdistrict 
                    INNER JOIN district on subdistrict.district_id=district.district_id
                    inner JOIN province on province.prv_id=district.prv_id
                    where lower(concat_ws('/',subdistrict.subdistrict_name, district.district_name, province.prv_name)) like :p1";
            $qry1 = Yii::$app->db->createCommand($sql1);
            $qry1->bindParam(':p1', $key, PDO::PARAM_STR);
            $datacount = $qry1->queryScalar();

            $sql2 = "select subdistrict.subdistrict_id, concat_ws('/',subdistrict.subdistrict_name, district.district_name, province.prv_name) as region from subdistrict 
                    INNER JOIN district on subdistrict.district_id=district.district_id
                    inner JOIN province on province.prv_id=district.prv_id
                    where lower(concat_ws('/',subdistrict.subdistrict_name, district.district_name, province.prv_name)) like :p1";
            $qry2 = Yii::$app->db->createCommand($sql2);
            $qry2->bindParam(':p1', $key, PDO::PARAM_STR);
            $dataall = $qry2->queryAll();

            if (!empty($dataall)) {
                foreach ($dataall as $ddx => $drow) {
                    $result['incomplete_results'] = false;
                    $result['total_count'] = $datacount;
                    $result['items'][$ddx]['id'] = $drow['subdistrict_id'];
                    $result['items'][$ddx]['text'] = $drow['region'];
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
