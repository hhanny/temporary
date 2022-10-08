<?php


namespace app\modules\apisrv\controllers\v1;

use Yii;
use app\components\Apisrv1Controller;
use app\models\Room;
use yii\web\Response;

class RoomController extends Apisrv1Controller
{
    public function actionGetlist()
    {
        $result = "<option>-</option>";
        $id = $_POST['id'];
        if (isset($id)) {
            $mdl = Room::find()->where(['clstroom_id' => $id, 'is_active' => true])->all();
            if (!empty($mdl)) {
                echo "<option value=''>Select</option>";
                foreach ($mdl as $row) {
                    echo "<option value='" . $row->room_id . "'>" . $row->room_name . "</option>";
                }
                exit;
            }
        }
        echo $result;
    }
}