<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Payment;
use yii\db\BatchQueryResult;

/**
 * PaymentSearch represents the model behind the search form of `app\models\Payment`.
 */
class PaymentSearch extends Payment
{
    public $pasien_name, $pasien_norm, $reg_num, $patient_guaranty;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_id', 'paytype_id', 'registration_id', 'nonpatient_id', 'hospital_id', 'created_by', 'deleted_by'], 'integer'],
            [['is_patient', 'is_deleted'], 'boolean'],
            [['description', 'created_time', 'deleted_time', 'pasien_name', 'pasien_norm', 'reg_num', 'patient_guaranty'], 'safe'],
            [['nominal'], 'number'],
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
    public function search($params, $type)
    {
        $query = Payment::find();
        $query->alias('t');
        $query->innerJoin('payment_type pt', 't.paytype_id=pt.paytype_id');
        $query->innerJoin('registration rg', 't.registration_id=rg.registration_id');
        $query->innerJoin('patient pn', 'rg.patient_id=pn.patient_id');
        $query->innerJoin('patient_guaranty pg', 'pg.guaranty_id=rg.guaranty_id');

        if ($type == self::PY_TNA) {
            $query->isTunai();
        } elseif ($type == self::PY_DISC) {
            $query->isDiscount();
        }

        $query->active();
        $query->orderBy(['created_time' => SORT_DESC]);

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
            't.payment_id' => $this->payment_id,
            't.paytype_id' => $this->paytype_id,
            't.registration_id' => $this->registration_id,
            't.nonpatient_id' => $this->nonpatient_id,
            't.is_patient' => $this->is_patient,
            't.nominal' => $this->nominal,
            't.hospital_id' => $this->hospital_id,
            't.created_by' => $this->created_by,
            't.created_time' => $this->created_time,
            't.is_deleted' => $this->is_deleted,
            't.deleted_by' => $this->deleted_by,
            't.deleted_time' => $this->deleted_time
        ]);

        $query->andFilterWhere(['ilike', 'rg.reg_num', $this->reg_num]);
        $query->andFilterWhere(['ilike', 'pg.name', $this->patient_guaranty]);
        $query->andFilterWhere(['ilike', 't.description', $this->description]);
        $query->andFilterWhere(['ilike', 'rg.mr_number', $this->pasien_norm]);
        $query->andFilterWhere(['ilike', 'pn.fullname', $this->pasien_name]);

        return $dataProvider;
    }
}
