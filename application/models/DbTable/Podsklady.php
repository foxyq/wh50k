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


}

