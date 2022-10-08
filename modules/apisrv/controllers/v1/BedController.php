<?php


namespace app\modules\apisrv\controllers\v1;


use app\components\Apisrv1Controller;
use app\models\Bed;

class BedController extends Apisrv1Controller
{
    public function actionGetlist()
    {
        $result = "<option>-</option>";
        $id = $_POST['id'];
        if (isset($id)) {
            $mdl = Bed::find()->where(['room_id' => $id, 'is_available' => true, 'is_active' => true])->all();
            if (!empty($mdl)) {
                echo "<option value=''>Select</option>";
                foreach ($mdl as $row) {
                    echo "<option value='" . $row->bed_id . "'>" . $row->bed_num . "</option>";
                }
                exit;
            }
        }
        echo $result;
    }
}