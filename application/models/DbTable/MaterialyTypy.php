<?php

class Application_Model_DbTable_MaterialyTypy extends Zend_Db_Table_Abstract
{

    protected $_name = 'materialy_typy';

    //vracanie názvov pre výpisy
    public function getNazov($id)
    {
        $id = (int)$id;
        $nazov = $this->fetchRow('materialy_typy_id = '.$id)->nazov;
        return $nazov;

    }

    //metoda vracia pole pre vypisy a formulare - id a nazov skladu
    public function getMoznosti()
    {
        $pole = $this->fetchAll()->toArray();
        $moznosti = array();

        foreach ($pole as $hodnota){
            $moznosti[$hodnota['materialy_typy_id']] = $hodnota['nazov'];
        }

        return $moznosti;
    }

}

