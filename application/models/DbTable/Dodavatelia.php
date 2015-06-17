<?php

class Application_Model_DbTable_Dodavatelia extends Zend_Db_Table_Abstract
{
	//namapovanie tabuľky podľa mena z databáze pre aplikáciu
    protected $_name = 'dodavatelia';

    //vracanie názvov pre výpisy
    public function getNazov($id)
    {
    	$id = (int)$id;
    	$nazov = $this->fetchRow('dodavatelia_id = '.$id)->meno;
    	return $nazov;
    }

}

