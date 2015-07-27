<?php

class Application_Model_DbTable_Prijmy extends Zend_Db_Table_Abstract
{
	//namapovanie tabuľky podľa mena z databáze pre aplikáciu
    protected $_name = 'ts_prijmy';

    public function getPrijem($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('ts_prijmy_id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        $row = $row->toArray();
        return $row;
    }

    public function getPrijemByDokladCislo($id)
    {
        //$id = $id;
        $row = $this->fetchRow("doklad_cislo = '" . $id."'");
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        $row = $row->toArray();
        return $row;
    }

    public function deletePrijem($id)
    {
        $this->delete('ts_prijmy_id =' . (int)$id);
    }

    public function addPrijem($datum_prijmu,
                              $sklad,
                              $podsklad,
                              $dodavatel,
                              $prepravca,
                              $prepravca_spz,
                              $q_tony_merane,
                              $q_tony_nadrozmer,
                              $doklad_typ,
                              $material_typ,
                              $material_druh,
                              $poznamka,
                              $chyba,
                              $stav_transakcie,
                            $doklad_cislo){
        $data = array(
            'datum_prijmu_d' => $datum_prijmu,
            'sklad_enum' => $sklad,
            'podsklad_enum' => $podsklad,
            'dodavatel_enum' => $dodavatel,
            'prepravca_enum' => $prepravca,
            'prepravca_spz' => $prepravca_spz,
            'q_tony_merane' => $q_tony_merane,
            'q_tony_nadrozmer' => $q_tony_nadrozmer,
            'doklad_typ_enum' => $doklad_typ,
            'material_typ_enum' => $material_typ,
            'material_druh_enum' => $material_druh,
            'poznamka' => $poznamka,
            'chyba' => $chyba,
            'stav_transakcie' => $stav_transakcie,
            'doklad_cislo' => $doklad_cislo,
            'vytvoril_u' => 1,
            'posledna_uprava_u' => 1

        );
        $this->insert($data);
    }

    public function editPrijem(
        $id,
        $datum_prijmu,
        $sklad,
        $podsklad,
        $dodavatel,
        $prepravca,
        $prepravca_spz,
        $q_tony_merane,
        $q_tony_nadrozmer,
        $doklad_typ,
        $material_druh,
        $material_typ,
        $poznamka,
        $chyba,
        $stav_transakcie){

        $data = array(
            'datum_prijmu_d' => $datum_prijmu,
            'sklad_enum' => $sklad,
            'podsklad_enum' => $podsklad,
            'dodavatel_enum' => $dodavatel,
            'prepravca_enum' => $prepravca,
            'prepravca_spz' => $prepravca_spz,
            'q_tony_merane' => $q_tony_merane,
            'q_tony_nadrozmer' => $q_tony_nadrozmer,
            'doklad_typ_enum' => $doklad_typ,
            'material_typ_enum' => $material_typ,
            'material_druh_enum' => $material_druh,
            'poznamka' => $poznamka,
            'chyba' => $chyba,
            'stav_transakcie' => $stav_transakcie,

            'vytvoril_u' => 1,
            'posledna_uprava_u' => 1

        );
        $this->update($data, 'ts_prijmy_id ='. (int)$id);

    }

    //get SUM of column1 by column2
    //toto nie je optimalne pri velkom mnozstve dat to bude dlho trvat
    public function getSumByColumn($column1, $column2, $column2_value){
       $prijmy = $this->fetchAll($column2.' = '.$column2_value);
        $sum = 0;
        foreach ($prijmy as $prijem){
            $sum = $sum + $prijem[$column1];
        }
        return $sum;
    }

    //get SUM of column1 by column2 (date) and column3 (stock)
    public function getSumByDateAndStock($column1, $column2, $column2_value, $column3, $column3_value){
       $prijmy = $this->fetchAll($column2." = '".$column2_value."' AND ".$column3." = ".$column3_value." AND stav_transakcie = 2");
        $sum = 0;
        foreach ($prijmy as $prijem){
            $sum = $sum + $prijem[$column1];
        }
        return $sum;
    }

    //$column1 - co sledujeme
    //$column2 - parametre od do
    //$column3 - goup by - standardne id skladu
    public function getSumByColumnBetween($column1, $column2, $column2_value1, $column2_value2, $column3, $column3_value1){

        if ($column2_value1 > $column2_value2){
            $pomocna = $column2_value2;
            $column2_value2 = $column2_value1;
            $column2_value1 = $pomocna;
        }

        $sql = $column3." = ".$column3_value1." AND (".$column2." BETWEEN '".$column2_value1."' AND '".$column2_value2."')";
        //$prijmy = $this->fetchAll($column2.' > '. $column2_value1);
        $prijmy = $this->fetchAll($sql);

        $sum = 0;
        foreach ($prijmy as $prijem){
            $sum = $sum + $prijem[$column1];
        }
        return $sum;
    }

    public function getColumnById($column, $id){
        $sql = "ts_prijmy_id = " . $id;
        $value = $this->fetchAll($sql);
        return $value[$column];
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

