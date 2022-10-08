<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Unit;
use Yii;

/**
 * UnitSearch represents the model behind the search form of `app\models\Unit`.
 */
class UnitSearch extends Unit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_id', 'hospital_id', 'created_by'], 'integer'],
            [['unit_code', 'unitgroup_id', 'unit_name', 'created_time', 'is_active', 'is_clinic'], 'safe'],
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
        $query = Unit::find();
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
            'unit_id' => $this->unit_id,
            'hospital_id' => $this->hospital_id,
            'is_active' => $this->is_active,
            'is_clinic' => $this->is_clinic,
            'created_by' => $this->created_by,
            'craeted_time' => $this->created_time,
        ]);

        $query->andFilterWhere(['ilike', 'unit_code', $this->unit_code])
            ->andFilterWhere(['ilike', 'unitgroup_id', $this->unitgroup_id])
            ->andFilterWhere(['ilike', 'unit_name', $this->unit_name]);

        return $dataProvider;
    }
}
