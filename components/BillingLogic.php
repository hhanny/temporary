<?php

namespace app\components;

use app\models\Billing;
use Yii;
use PDO;

class BillingLogic extends Billing
{
    public $total_tagihan, $total_bayar, $total_biaya, $total_diskon, $sisa_bayar;

    public function attributeLabels()
    {
        return [
            'total_tagihan' => 'Total Tagihan',
            'total_bayar' => 'Total Bayar',
            'total_biaya' => 'Total Biaya',
            'sisa_bayar' => 'Sisa Bayar'
        ];
    }

    /*
     * list data transaksi pasien
     */
    public static function getListByUGID($rid, $ugid, $search, $start, $length)
    {
        $param = [
            't.registration_id' => $rid,
            't.unitgroup_id' => $ugid,
            't.is_deleted' => false
        ];
        $query = self::find()
            ->alias('t')
            ->innerJoin('product_rate pr', 'pr.prdrate_id=t.prdrate_id')
            ->innerJoin('product pd', 'pd.product_id=pr.product_id');
        $query->where($param);

        $totalRow = self::find()
            ->select('count(*)')
            ->alias('t')
            ->innerJoin('product_rate pr', 'pr.prdrate_id=t.prdrate_id')
            ->innerJoin('product pd', 'pd.product_id=pr.product_id');
        $totalRow->where($param);
        // total record tanpa filter
        $countAll = $totalRow->scalar();


        if (!empty($search)) {
            $query->andWhere(['like', 'lower(pd.name)', strtolower($search)]);
            $totalRow->andWhere(['like', 'lower(pd.name)', strtolower($search)]);
        }
        $query->offset = $start;
        $query->limit = $length;
        $data = $query->all();

        $totalRow->offset = $start;
        $totalRow->limit = $length;
        $count = $totalRow->scalar();

        return ['data' => $data, 'count' => $count, 'countAll' => $countAll];
    }

    /*
     * Total Transaksi pada tabel billing yang berstatus aktif
     */
    public static function getBiaya($rid)
    {
        $sql = "select coalesce(sum(total),0) from billing where registration_id = :rid and is_deleted = false";
        $qry = Yii::$app->db->createCommand($sql);
        $qry->bindParam(':rid', $rid, PDO::PARAM_INT);
        return $qry->queryScalar();
    }

    public static function getDiskon($rid)
    {
        $sql = "select coalesce(sum(nominal),0) from payment py 
                    inner join payment_type pt on py.paytype_id=pt.paytype_id where py.registration_id = :p1 and pt.is_discount = true and py.is_deleted = false";
        $qry = Yii::$app->db->createCommand($sql);
        $qry->bindParam(':p1', $rid, PDO::PARAM_INT);
        return $qry->queryScalar();
    }

    /*
     * total Tagihan = Biaya - Diskon
     *
     */
    public static function getTagihan($rid)
    {
        return self::getBiaya($rid) - self::getDiskon($rid);
    }

    public static function getJmlBayar($rid)
    {
        $sql = "select coalesce(sum(nominal),0) from payment py 
                    inner join payment_type pt on py.paytype_id=pt.paytype_id 
                    where py.registration_id = :p1 and pt.is_discount = false and py.is_deleted = false";
        $qry = Yii::$app->db->createCommand($sql);
        $qry->bindParam(':p1', $rid, PDO::PARAM_INT);
        return $qry->queryScalar();
    }

    /*
     * sisa bayar = tagihan - jumlah bayar
     */
    public static function getSisaBayar($rid)
    {
        return self::getTagihan($rid) - self::getJmlBayar($rid);
    }
}