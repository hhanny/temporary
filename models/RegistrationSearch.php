<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Registration;

/**
 * RegistrationSearch represents the model behind the search form of `app\models\Registration`.
 */
class RegistrationSearch extends Registration
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['registration_id', 'doctor_id', 'regref_id', 'guaranty_id', 'rate_id', 'hospital_id', 'unit_id', 'patient_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['regstts_id', 'picrel_id', 'regsource_id', 'emergency_id', 'reason_id', 'reg_num', 'mr_number', 'date_in', 'date_out', 'time_in',
                'time_out', 'emergency_escort', 'gl_letter_num', 'sender_name', 'pic_name', 'pic_phone', 'pic_address', 'created_time', 'updated_time', 'deleted_time', 'reg_patient_name', 'class_id', 'clstroom_id'], 'safe'],
            [['is_new_patient', 'is_new_unit', 'is_inpatient', 'is_deleted'], 'boolean'],
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
    public function search($params, $is_inpatient, $regstatus = null)
    {
        $query = Registration::find();
        $query->alias('t');
        $query->joinWith(['patient', 'unit']);

        $query->where([
            't.hospital_id' => Yii::$app->user->identity->hospital_id,
            't.is_inpatient' => $is_inpatient,
            't.is_deleted' => false
        ]);

        if ($is_inpatient) {
            $query->select('t.*, ri.class_id, cr.class_name, cl.cls_room, cl.clstroom_id, r.room_name, b.bed_num');
            $query->innerJoin('registration_inpatient ri', 'ri.registration_id=t.registration_id');
            $query->innerJoin('class_room cr', 'ri.class_id=cr.class_id');
            $query->innerJoin('bed b', 'b.bed_id=ri.bed_id');
            $query->innerJoin('room r', 'r.room_id=b.room_id');
            $query->innerJoin('cluster_room cl', 'cl.clstroom_id=r.clstroom_id');
            if ($regstatus == self::Active) {
                $query->andWhere(['ri.is_active' => true]);
            } else {
                $query->andWhere(['ri.is_active' => false]);
            }
        }
        if ($regstatus == self::Active) {
            $query->andWhere(['t.regstts_id' => $regstatus]);
        } else {
            $query->andWhere('t.regstts_id != :p1', [':p1' => self::Active]);
        }

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
            't.registration_id' => $this->registration_id,
            't.doctor_id' => $this->doctor_id,
            't.regref_id' => $this->regref_id,
            't.guaranty_id' => $this->guaranty_id,
            't.rate_id' => $this->rate_id,
            't.hospital_id' => $this->hospital_id,
            't.unit_id' => $this->unit_id,
            't.patient_id' => $this->patient_id,
            't.date_in' => $this->date_in,
            't.date_out' => $this->date_out,
            't.time_in' => $this->time_in,
            't.time_out' => $this->time_out,
            't.is_new_patient' => $this->is_new_patient,
            't.is_new_unit' => $this->is_new_unit,
            't.is_inpatient' => $this->is_inpatient,
            't.created_by' => $this->created_by,
            't.created_time' => $this->created_time,
            't.updated_by' => $this->updated_by,
            't.updated_time' => $this->updated_time,
            't.is_deleted' => $this->is_deleted,
            't.deleted_by' => $this->deleted_by,
            't.deleted_time' => $this->deleted_time,
        ]);

        if ($is_inpatient) {
            $query->andFilterWhere([
                'r.clstroom_id' => $this->clstroom_id,
                'ri.class_id' => $this->class_id
            ]);
        }


        $query->andFilterWhere(['ilike', 't.regstts_id', $this->regstts_id])
            ->andFilterWhere(['ilike', 't.picrel_id', $this->picrel_id])
            ->andFilterWhere(['ilike', 't.regsource_id', $this->regsource_id])
            ->andFilterWhere(['ilike', 't.emergency_id', $this->emergency_id])
            ->andFilterWhere(['ilike', 't.reason_id', $this->reason_id])
            ->andFilterWhere(['ilike', 't.reg_num', $this->reg_num])
            ->andFilterWhere(['ilike', 't.mr_number', $this->mr_number])
            ->andFilterWhere(['ilike', 't.emergency_escort', $this->emergency_escort])
            ->andFilterWhere(['ilike', 't.gl_letter_num', $this->gl_letter_num])
            ->andFilterWhere(['ilike', 't.sender_name', $this->sender_name])
            ->andFilterWhere(['ilike', 't.pic_name', $this->pic_name])
            ->andFilterWhere(['ilike', 't.pic_phone', $this->pic_phone])
            ->andFilterWhere(['ilike', 't.pic_address', $this->pic_address])
            ->andFilterWhere(['ilike', 'patient.fullname', $this->reg_patient_name]);

        return $dataProvider;
    }

    public function getPasienActive()
    {
        return self::find()->where(['hospital_id' => Yii::$app->user->identity->hospital_id, 'regstts_id' => self::Active]);
    }
}
