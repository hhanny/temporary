<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ClusterRoom;

/**
 * ClusterRoomSearch represents the model behind the search form of `app\models\ClusterRoom`.
 */
class ClusterRoomSearch extends ClusterRoom
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clstroom_id', 'hospital_id', 'created_by', 'updated_by'], 'integer'],
            [['cls_room', 'created_time', 'updated_time'], 'safe'],
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
        $query = ClusterRoom::find();

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
            'clstroom_id' => $this->clstroom_id,
            'hospital_id' => $this->hospital_id,
            'created_by' => $this->created_by,
            'created_time' => $this->created_time,
            'updated_by' => $this->updated_by,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['ilike', 'cls_room', $this->cls_room]);

        return $dataProvider;
    }
}
