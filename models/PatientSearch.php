<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Patient;

/**
 * PatientSearch represents the model behind the search form of `app\models\Patient`.
 */
class PatientSearch extends Patient
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['patient_id', 'job_id', 'hospital_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['marital_status_id', 'gender_id', 'education_id', 'blood_id', 'religion_id', 'subdistrict_id', 'ethnic_id', 'mr_number', 'fullname', 'nickname', 'identity_number', 'address', 'village', 'phone', 'birth_place', 'date_of_birth', 'office_address', 'created_time', 'updated_time', 'deleted_time'], 'safe'],
            [['is_deleted'], 'boolean'],
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
        $rs = new RegistrationSearch();
        $ptnActive = $rs->getPasienActive()->select('patient_id')->asArray()->all();
        $query = Patient::find();
        $query->where(['hospital_id' => \Yii::$app->user->identity->hospital_id]);
        $query->andWhere(['not in', 'patient_id', $ptnActive]);

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
            'patient_id' => $this->patient_id,
            'job_id' => $this->job_id,
            'hospital_id' => $this->hospital_id,
            'date_of_birth' => $this->date_of_birth,
            'created_by' => $this->created_by,
            'created_time' => $this->created_time,
            'updated_by' => $this->updated_by,
            'updated_time' => $this->updated_time,
            'is_deleted' => $this->is_deleted,
            'deleted_by' => $this->deleted_by,
            'deleted_time' => $this->deleted_time,
        ]);

        $query->andFilterWhere(['ilike', 'marital_status_id', $this->marital_status_id])
            ->andFilterWhere(['ilike', 'gender_id', $this->gender_id])
            ->andFilterWhere(['ilike', 'education_id', $this->education_id])
            ->andFilterWhere(['ilike', 'blood_id', $this->blood_id])
            ->andFilterWhere(['ilike', 'religion_id', $this->religion_id])
            ->andFilterWhere(['ilike', 'subdistrict_id', $this->subdistrict_id])
            ->andFilterWhere(['ilike', 'ethnic_id', $this->ethnic_id])
            ->andFilterWhere(['ilike', 'mr_number', $this->mr_number])
            ->andFilterWhere(['ilike', 'fullname', $this->fullname])
            ->andFilterWhere(['ilike', 'nickname', $this->nickname])
            ->andFilterWhere(['ilike', 'identity_number', $this->identity_number])
            ->andFilterWhere(['ilike', 'address', $this->address])
            ->andFilterWhere(['ilike', 'village', $this->village])
            ->andFilterWhere(['ilike', 'phone', $this->phone])
            ->andFilterWhere(['ilike', 'birth_place', $this->birth_place])
            ->andFilterWhere(['ilike', 'office_address', $this->office_address]);

        return $dataProvider;
    }

}
