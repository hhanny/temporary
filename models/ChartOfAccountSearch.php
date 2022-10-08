<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ChartOfAccount;

/**
 * ChartOfAccountSearch represents the model behind the search form of `app\models\ChartOfAccount`.
 */
class ChartOfAccountSearch extends ChartOfAccount
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coa_id', 'hospital_id', 'parent', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['ccat_code', 'coa_code', 'coa_name', 'coa_description', 'created_time', 'updated_time', 'deleted_time'], 'safe'],
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
        $query = ChartOfAccount::find();
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
            'coa_id' => $this->coa_id,
            'hospital_id' => $this->hospital_id,
            'parent' => $this->parent,
            'is_active' => $this->is_active,
            'created_by' => $this->created_by,
            'created_time' => $this->created_time,
            'updated_by' => $this->updated_by,
            'updated_time' => $this->updated_time,
            'is_deleted' => $this->is_deleted,
            'deleted_by' => $this->deleted_by,
            'deleted_time' => $this->deleted_time,
        ]);

        $query->andFilterWhere(['ilike', 'ccat_code', $this->ccat_code])
            ->andFilterWhere(['ilike', 'coa_code', $this->coa_code])
            ->andFilterWhere(['ilike', 'coa_name', $this->coa_name])
            ->andFilterWhere(['ilike', 'coa_description', $this->coa_description]);

        return $dataProvider;
    }
}
