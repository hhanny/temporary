<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bed;

/**
 * BedSearch represents the model behind the search form of `app\models\Bed`.
 */
class BedSearch extends Bed
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bed_id', 'hospital_id', 'room_id', 'created_by', 'updated_by'], 'integer'],
            [['bed_num', 'created_time', 'updated_time', 'sRoomName', 'sClusterName'], 'safe'],
            [['is_active', 'is_available'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Bed::find()
            ->alias('t')
            ->leftJoin('room r', 'r.room_id=t.room_id')
            ->leftJoin('cluster_room c', 'c.clstroom_id=r.clstroom_id')
            ->where(['t.hospital_id' => \Yii::$app->user->identity->hospital_id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            't.bed_id' => $this->bed_id,
            't.hospital_id' => $this->hospital_id,
            't.room_id' => $this->room_id,
            't.is_active' => $this->is_active,
            't.is_available'=>$this->is_available,
            't.created_by' => $this->created_by,
            't.created_time' => $this->created_time,
            't.updated_by' => $this->updated_by,
            't.updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['ilike', 't.bed_num', $this->bed_num])
            ->andFilterWhere(['ilike', 'r.room_name', $this->sRoomName])
            ->andFilterWhere(['ilike', 'c.cls_room', $this->sClusterName]);

        return $dataProvider;
    }
}
