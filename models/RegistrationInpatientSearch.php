<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RegistrationInpatient;

/**
 * RegistrationInpatientSearch represents the model behind the search form of `app\models\RegistrationInpatient`.
 */
class RegistrationInpatientSearch extends RegistrationInpatient
{
    public $sRNum, $sMRNum, $sPName, $sBedNum;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inpatien_id', 'registration_id', 'class_id', 'bed_id', 'created_by', 'updated_by'], 'integer'],
            [['is_active'], 'boolean'],
            [['date_in', 'time_in', 'date_out', 'time_out', 'created_time', 'updated_time', 'sRNum', 'sMRNum', 'sPName', 'sClusterName', 'sRoomName', 'sBedNum'], 'safe'],
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
        $query = RegistrationInpatient::find()
            ->alias('t')
            ->innerJoin('registration r', 'r.registration_id=t.registration_id')
            ->innerJoin('patient p', 'p.patient_id=r.patient_id')
            ->innerJoin('bed b', 'b.bed_id=t.bed_id')
            ->innerJoin('room o', 'o.room_id=b.room_id')
            ->innerJoin('cluster_room c', 'c.clstroom_id=o.clstroom_id');
        $query->where(['r.hospital_id' => \Yii::$app->user->identity->hospital_id, 'r.is_deleted' => false, 't.is_active' => true]);

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
            't.inpatien_id' => $this->inpatien_id,
            't.registration_id' => $this->registration_id,
            't.class_id' => $this->class_id,
            't.bed_id' => $this->bed_id,
            't.is_active' => $this->is_active,
            't.date_in' => $this->date_in,
            't.time_in' => $this->time_in,
            't.date_out' => $this->date_out,
            't.time_out' => $this->time_out,
            't.created_by' => $this->created_by,
            't.created_time' => $this->created_time,
            't.updated_by' => $this->updated_by,
            't.updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['ilike', 'c.cls_room', $this->sClusterName])
            ->andFilterWhere(['ilike', 'o.room_name', $this->sRoomName])
            ->andFilterWhere(['ilike', 'b.bed_num', $this->sBedNum])
            ->andFilterWhere(['ilike', 'r.reg_num', $this->sRNum])
            ->andFilterWhere(['ilike', 'r.mr_number', $this->sMRNum])
            ->andFilterWhere(['ilike', 'p.fullname', $this->sPName]);

        return $dataProvider;
    }
}
