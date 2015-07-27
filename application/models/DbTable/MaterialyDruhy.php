<?php

class Application_Model_DbTable_MaterialyDruhy extends Zend_Db_Table_Abstract
{

    protected $_name = 'materialy_druhy';

    //vracanie názvov pre výpisy
    public function getNazov($id)
    {
        $id = (int)$id;
        $nazov = $this->fetchRow('materialy_druhy_id = '.$id)->nazov;
        return $nazov;

    }

    //metoda vracia pole pre vypisy a formulare - id a nazov skladu
    public function getMoznosti()
    {
        $pole = $this->fetchAll()->toArray();
        $moznosti = array();

        foreach ($pole as $hodnota){
            $moznosti[$hodnota['materialy_druhy_id']] = $hodnota['nazov'];
        }

        return $moznosti;
    }
    //vrati pole s koeficientami pre konverzie podla druhu materialu
    public function getKonverzie($druhId){
        $konverzie = array();
        $sql = "materialy_druhy_id = ".$druhId;
        $row = $this->fetchRow($sql);

        $konverzie['m3_ton'] = $row['m3_ton'];
        $konverzie['m3_prm'] = $row['m3_prm'];
        $konverzie['ton_m3'] = $row['ton_m3'];
        $konverzie['ton_prm'] = $row['ton_prm'];
        $konverzie['prm_ton'] = $row['prm_ton'];
        $konverzie['prm_m3'] = $row['prm_m3'];

        return $konverzie;

    }


}

