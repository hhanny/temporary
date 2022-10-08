<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ClassRoom;

/**
 * ClassRoomSearch represents the model behind the search form of `app\models\ClassRoom`.
 */
class ClassRoomSearch extends ClassRoom
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_id', 'hospital_id', 'created_by', 'updated_by'], 'integer'],
            [['class_name', 'created_time', 'updated_time'], 'safe'],
            [['is_active', 'is_general'], 'boolean'],
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
        $query = ClassRoom::find();
        $query->where(['hospital_id' => Yii::$app->user->identity->hospital_id]);

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
            'class_id' => $this->class_id,
            'hospital_id' => $this->hospital_id,
            'is_active' => $this->is_active,
            'created_by' => $this->created_by,
            'created_time' => $this->created_time,
            'updated_by' => $this->updated_by,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['ilike', 'class_name', $this->class_name]);

        return $dataProvider;
    }
}
