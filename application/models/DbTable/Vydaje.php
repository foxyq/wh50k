<?php

class Application_Model_DbTable_Vydaje extends Zend_Db_Table_Abstract
{

    protected $_name = 'ts_vydaje';

    public function getVydaj($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('ts_vydaje_id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }


    public function getVydajByDokladCislo($id)
    {
        $id = $id;
        $row = $this->fetchRow("doklad_cislo = '" . $id."'");
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        $row = $row->toArray();
        return $row;
    }

    public function addVydaj($datum_vydaju,
                              $sklad,
                              $podsklad,
                              $zakaznik,
                              $prepravca,
                              $prepravca_spz,
                              $q_tony_merane,
                              $doklad_typ,
                              $material_typ,
                              $material_druh,
                              $poznamka,
                              $chyba,
                              $stav_transakcie,
                             $doklad_cislo){
        $data = array(
            'datum_vydaju_d' => $datum_vydaju,
            'sklad_enum' => $sklad,
            'podsklad_enum' => $podsklad,
            'zakaznik_enum' => $zakaznik,
            'prepravca_enum' => $prepravca,
            'prepravca_spz' => $prepravca_spz,
            'q_tony_merane' => $q_tony_merane,
            'doklad_typ_enum' => $doklad_typ,
            'material_typ_enum' => $material_typ,
            'material_druh_enum' => $material_druh,
            'poznamka' => $poznamka,
            'chyba' => $chyba,
            'stav_transakcie' => $stav_transakcie,
            'doklad_cislo' => $doklad_cislo,
            'vytvoril_u' => 1, //TODO podla logged in usera
            'posledna_uprava_u' => 1, // TODO ^ same shit


        );
//        var_dump( $data);
        $this->insert($data);
    }


    public function editVydaj(
                            $id,
                            $datum_vydaju,
                             $sklad,
                             $podsklad,
                             $zakaznik,
                             $prepravca,
                             $prepravca_spz,
                             $q_tony_merane,
                             $doklad_typ,
                             $material_typ,
                             $material_druh,
                             $poznamka,
                             $chyba,
                             $stav_transakcie){
        $data = array(
            'datum_vydaju_d' => $datum_vydaju,
            'sklad_enum' => $sklad,
            'podsklad_enum' => $podsklad,
            'zakaznik_enum' => $zakaznik,
            'prepravca_enum' => $prepravca,
            'prepravca_spz' => $prepravca_spz,
            'q_tony_merane' => $q_tony_merane,
            'doklad_typ_enum' => $doklad_typ,
            'material_typ_enum' => $material_typ,
            'material_druh_enum' => $material_druh,
            'poznamka' => $poznamka,
            'chyba' => $chyba,
            'stav_transakcie' => $stav_transakcie,

            'vytvoril_u' => 1, //TODO podla logged in usera
            'posledna_uprava_u' => 1 // TODO ^ same shit

        );
        $this->update($data, 'ts_vydaje_id ='. (int)$id);
    }

    public function deleteVydaj($id)
    {
        $this->delete('ts_vydaje_id =' . (int)$id);
    }

    //get SUM of column1 by column2
    //toto nie je optimalne pri velkom mnozstve dat to bude dlho trvat
    public function getSumByColumn($column1, $column2, $column2_value){
        $vydaje = $this->fetchAll($column2.' = '. $column2_value);
        $sum = 0;
        foreach ($vydaje as $vydaj){
            $sum = $sum + $vydaj[$column1];
        }
        return $sum;
    }

    //get SUM of column1 by column2 (date) and column3 (stock)
    public function getSumByDateAndStock($column1, $column2, $column2_value, $column3, $column3_value){
        $vydaje = $this->fetchAll($column2." = '".$column2_value."' AND ".$column3." = ".$column3_value." AND stav_transakcie = 2");
        $sum = 0;
        foreach ($vydaje as $vydaj){
            $sum = $sum + $vydaj[$column1];
        }
        return $sum;
    }

    public function getNumberOfErrors(){
            $select = $this->select();
            $select->from($this, array('count(*) as amount'))->where("chyba = 1");
            $rows = $this->fetchAll($select);

            return($rows[0]->amount);
    }

    public function getNumberOfWaitings(){
            $select = $this->select();
            $select->from($this, array('count(*) as amount'))->where("stav_transakcie = 1");
            $rows = $this->fetchAll($select);

            return($rows[0]->amount);
    }
}

