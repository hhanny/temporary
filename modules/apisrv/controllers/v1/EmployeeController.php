<?php


namespace app\modules\apisrv\controllers\v1;


use Yii;
use yii\web\Response;
use app\models\Employee;
use yii\web\Controller;

class EmployeeController extends Controller
{
    public function actionGetlist()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $key = $_GET['key'];
            if (empty($key)) {
                $key = 'X';
            }
            $datacount = Employee::find()
                ->andWhere('LOWER(employee_id::VARCHAR) LIKE :key OR LOWER(person_name) LIKE :key', [':key' => '%' . strtolower($key) . '%'])
                ->andWhere('hospital_id = :p1', [':p1' => Yii::$app->user->identity->hospital_id])
                ->count();

            $dataall = Employee::find()
                ->andWhere('LOWER(employee_id::VARCHAR) LIKE :key OR LOWER(person_name) LIKE :key', [':key' => '%' . strtolower($key) . '%'])
                ->andWhere('hospital_id = :p1', [':p1' => Yii::$app->user->identity->hospital_id])
                ->all();

            if (!empty($dataall)) {
                foreach ($dataall as $ddx => $drow) {
                    $result['incomplete_results'] = false;
                    $result['total_count'] = $datacount;
                    $result['items'][$ddx]['id'] = $drow->person_id;
                    $result['items'][$ddx]['text'] = $drow->employee_id . ' - ' . $drow->person_name;
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