<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mrrekammedik;

/**
 * Mrrekammediksearch represents the model behind the search form of `app\models\Mrrekammedik`.
 */
class Mrrekammediksearch extends Mrrekammedik
{
    // public $jenisctev;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rekammedik_id', 'infonoso_id', 'kasus_id', 'statuskembali_id', 'statuslengkap_id'], 'integer'],
            [['jenisctev_id', 'tuna_kode', 'ugdlayanan_id', 'alasandirujuk_id', 'ugddiagnosa_id', 'no_reg', 'anemnesa'], 'safe'],
            // [['jenisctev_id', 'tuna_kode', 'ugdlayanan_id', 'alasandirujuk_id', 'ugddiagnosa_id', 'no_reg', 'anemnesa','jenisctev'], 'safe'],
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
        $query = Mrrekammedik::find();
        $query->leftJoin('mrjenisctev', 'mrrekammedik.jenisctev_id = mrjenisctev.jenisctev_id');
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
            'rekammedik_id' => $this->rekammedik_id,
            'infonoso_id' => $this->infonoso_id,
            'kasus_id' => $this->kasus_id,
            'statuskembali_id' => $this->statuskembali_id,
            'statuslengkap_id' => $this->statuslengkap_id,
        ]);

        $query->andFilterWhere(['ilike', 'jenisctev_id', $this->jenisctev_id])
            ->andFilterWhere(['ilike', 'tuna_kode', $this->tuna_kode])
            ->andFilterWhere(['ilike', 'ugdlayanan_id', $this->ugdlayanan_id])
            ->andFilterWhere(['ilike', 'alasandirujuk_id', $this->alasandirujuk_id])
            ->andFilterWhere(['ilike', 'ugddiagnosa_id', $this->ugddiagnosa_id])
            ->andFilterWhere(['ilike', 'no_reg', $this->no_reg])
            ->andFilterWhere(['ilike', 'anemnesa', $this->anemnesa]);
            //->andFilterWhere(['ilike', 'mrjenisctev.jenis_ctev', $this->jenisctev]);

        return $dataProvider;
    }
}
