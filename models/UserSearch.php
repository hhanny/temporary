<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;
use Yii;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    public $emp_id, $emp_name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'person_id'], 'integer'],
            [['username', 'password', 'last_login', 'created_by', 'created_time', 'emp_id', 'emp_name'], 'safe'],
            [['is_active'], 'boolean'],
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
        $query = User::find()
            ->alias('t')
            ->leftJoin('employee e', 'e.person_id=t.person_id')
            ->where(['t.hospital_id' => Yii::$app->user->identity->hospital_id]);

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
            'user_id' => $this->user_id,
            'person_id' => $this->person_id,
            'is_active' => $this->is_active,
            'last_login' => $this->last_login,
            'created_time' => $this->created_time,
        ]);

        $query->andFilterWhere(['ilike', 'username', $this->username])
            ->andFilterWhere(['ilike', 'e.employee_id', $this->emp_id])
            ->andFilterWhere(['ilike', 'e.person_name', $this->emp_name])
            ->andFilterWhere(['ilike', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
