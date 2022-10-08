<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JournalType;

/**
 * JournalTypeSearch represents the model behind the search form of `app\models\JournalType`.
 */
class JournalTypeSearch extends JournalType
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jtype_id', 'hospital_id', 'debet_coa_id', 'credit_coa_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['code', 'jrtype_name', 'jrgroup_id', 'debet_coa_code', 'credit_coa_code', 'created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['is_active', 'is_deleted'], 'boolean'],
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
        $query = JournalType::find();
        $query->where(['hospital_id' => \Yii::$app->user->identity->hospital_id, 'is_deleted' => false]);

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
            'jtype_id' => $this->jtype_id,
            'hospital_id' => $this->hospital_id,
            'debet_coa_id' => $this->debet_coa_id,
            'credit_coa_id' => $this->credit_coa_id,
            'is_active' => $this->is_active,
            'created_by' => $this->created_by,
            'created_time' => $this->created_time,
            'updated_by' => $this->updated_by,
            'updated_time' => $this->updated_time,
            'is_deleted' => $this->is_deleted,
            'deleted_by' => $this->deleted_by,
            'deleted_time' => $this->deleted_time,
            'jrgroup_id' => $this->jrgroup_id
        ]);

        $query->andFilterWhere(['ilike', 'code', $this->code])
            ->andFilterWhere(['ilike', 'jrtype_name', $this->jrtype_name])
            ->andFilterWhere(['ilike', 'debet_coa_code', $this->debet_coa_code])
            ->andFilterWhere(['ilike', 'credit_coa_code', $this->credit_coa_code]);

        return $dataProvider;
    }
}
