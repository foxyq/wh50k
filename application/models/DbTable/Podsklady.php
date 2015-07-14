<?php

class Application_Model_DbTable_Podsklady extends Zend_Db_Table_Abstract
{
	//namapovanie tabuľky podľa mena z databáze pre aplikáciu
    protected $_name = 'podsklady';

    //vracanie názvov pre výpisy
    public function getNazov($id)
    {
    	$id = (int)$id;
    	$nazov = $this->fetchRow('podsklady_id = '.$id)->nazov_podskladu;
    	return $nazov;
    }

    //metoda vracia pole pre vypisy a formulare - id a nazov skladu
    public function getMoznosti()
    {
        $pole = $this->fetchAll()->toArray();
        $moznosti = array();

        foreach ($pole as $hodnota){
            $moznosti[$hodnota['podsklady_id']] = $hodnota['nazov_podskladu'];
        }

        return $moznosti;
    }


}

