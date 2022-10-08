<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InventorySmallUnit;

/**
 * InventorySmallUnitSearch represents the model behind the search form of `app\models\InventorySmallUnit`.
 */
class InventorySmallUnitSearch extends InventorySmallUnit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['smallunit_id', 'small_unit', 'created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['is_active', 'is_deleted'], 'boolean'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
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
        $query = InventorySmallUnit::find();
        $query->where(['is_active' => true, 'is_deleted' => false]);

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
            'is_active' => $this->is_active,
            'created_by' => $this->created_by,
            'created_time' => $this->created_time,
            'updated_by' => $this->updated_by,
            'updated_time' => $this->updated_time,
            'is_deleted' => $this->is_deleted,
            'deleted_by' => $this->deleted_by,
            'deleted_time' => $this->deleted_time,
        ]);

        $query->andFilterWhere(['ilike', 'smallunit_id', $this->smallunit_id])
            ->andFilterWhere(['ilike', 'small_unit', $this->small_unit]);

        return $dataProvider;
    }
}
