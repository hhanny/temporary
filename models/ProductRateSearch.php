<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductRate;

/**
 * ProductRateSearch represents the model behind the search form of `app\models\ProductRate`.
 */
class ProductRateSearch extends ProductRate
{
    public $prd_name, $unitgroup_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prdrate_id', 'hospital_id', 'product_id', 'class_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['name', 'created_time', 'updated_time', 'deleted_time', 'prd_name', 'unitgroup_id'], 'safe'],
            [['nominal'], 'number'],
            [['is_active', 'is_deleted'], 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'prd_name' => Yii::t('app', 'PRD Name'),
            'unitgroup_id' => Yii::t('app', 'UGID'),
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
        $query = ProductRate::find()
            ->alias('t')
            ->joinWith('product')
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
            't.prdrate_id' => $this->prdrate_id,
            't.hospital_id' => $this->hospital_id,
            't.product_id' => $this->product_id,
            't.class_id' => $this->class_id,
            't.nominal' => $this->nominal,
            't.is_active' => $this->is_active,
            't.created_by' => $this->created_by,
            't.created_time' => $this->created_time,
            't.updated_by' => $this->updated_by,
            't.updated_time' => $this->updated_time,
            't.is_deleted' => $this->is_deleted,
            't.deleted_by' => $this->deleted_by,
            't.deleted_time' => $this->deleted_time,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name]);
        $query->andFilterWhere(['ilike', 'product.unitgroup_id', $this->unitgroup_id]);
        $query->andFilterWhere(['ilike', 'product.name', $this->prd_name]);

        return $dataProvider;
    }
}
