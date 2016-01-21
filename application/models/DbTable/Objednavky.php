<?php

class Application_Model_DbTable_Objednavky extends Zend_Db_Table_Abstract
{

    protected $_name = 'objednavky';

    public function getObjednavka($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('objednavky_id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function getIds()
    {
        $objednavky = $this->fetchAll()->toArray();
        $ids = array();

        foreach ($objednavky as $objednavka) {
            $ids[] = $objednavka['objednavky_id'];
        }
        return $ids;
    }

    //$zakaznik, $rok, $mesiac, $mnozstvo, $merna_jednotka, $poznamka
    public function addObjednavka($zakaznik, $rok, $mesiac, $mnozstvo, $merna_jednotka, $poznamka)
    {
        $data = array(
            'rok_enum' => $rok,
            'mesiac_enum' => $mesiac,
            'mnozstvo' => $mnozstvo,
            'zakaznik_enum' => $zakaznik,
            'merna_jednotka_enum' => $merna_jednotka,
            'poznamka' => $poznamka
        );
        $this->insert($data);
    }

    //$zakaznik, $rok, $mesiac, $mnozstvo, $merna_jednotka, $poznamka
    public function updateObjednavka($id, $zakaznik, $rok, $mesiac, $mnozstvo, $merna_jednotka, $poznamka)
    {
        $data = array(
            'rok_enum' => $rok,
            'mesiac_enum' => $mesiac,
            'mnozstvo' => $mnozstvo,
            'zakaznik_enum' => $zakaznik,
            'merna_jednotka_enum' => $merna_jednotka,
            'poznamka' => $poznamka
        );
        $this->update($data, 'objednavky_id = '. (int)$id);
    }

    public function deleteObjednavka($id)
    {
        $this->delete('objednavky_id =' . (int)$id);
    }

    //kontrola ci v objednavkach existuje na toto obdobie pre tohto zakaznika objednavka - ak ano, nesmie byt nova vytvorena
    //pre validator
    public function existujeObjednavka($rok_enum, $mesiac_enum, $zakaznik_enum){
        //echo $rok_enum."+".$mesiac_enum."+".$zakaznik_enum;
        $sql = "rok_enum = ".$rok_enum." AND mesiac_enum = ".$mesiac_enum." AND zakaznik_enum = ".$zakaznik_enum;
        $objednavky = $this->fetchAll($sql);
        $pocetObjednavok = count($objednavky);
        //echo "existuje duplicita? = ".$pocetObjednavok;
        if ($pocetObjednavok > 0){
            return true;
        }else{
            return false;
        }
    }
}

