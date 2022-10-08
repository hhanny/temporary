<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Manufactory;

/**
 * ManufactorySearch represents the model behind the search form of `app\models\Manufactory`.
 */
class ManufactorySearch extends Manufactory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['factory_id', 'hospital_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['name', 'address', 'phone', 'pic_name', 'pic_phone', 'created_time', 'updated_time', 'deleted_time'], 'safe'],
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
        $query = Manufactory::find();
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
            'factory_id' => $this->factory_id,
            'hospital_id' => $this->hospital_id,
            'is_active' => $this->is_active,
            'created_by' => $this->created_by,
            'created_time' => $this->created_time,
            'updated_by' => $this->updated_by,
            'updated_time' => $this->updated_time,
            'is_deleted' => $this->is_deleted,
            'deleted_by' => $this->deleted_by,
            'deleted_time' => $this->deleted_time,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'address', $this->address])
            ->andFilterWhere(['ilike', 'phone', $this->phone])
            ->andFilterWhere(['ilike', 'pic_name', $this->pic_name])
            ->andFilterWhere(['ilike', 'pic_phone', $this->pic_phone]);

        return $dataProvider;
    }
}
