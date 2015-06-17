<?php

class Application_Model_DbTable_Sklady extends Zend_Db_Table_Abstract
{
	//namapovanie tabuľky podľa mena z databáze pre aplikáciu
    protected $_name = 'sklady';

    protected $_dependentTables = array('Prijmy');

    //vracanie názvov pre výpisy
    public function getNazov($id)
    {
    	$id = (int)$id;
    	$nazov = $this->fetchRow('sklady_id = '.$id)->nazov_skladu;
    	return $nazov;

    }




}

