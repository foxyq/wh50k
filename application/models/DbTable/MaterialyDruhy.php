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


}

