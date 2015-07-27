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
        $nazov = $this->fetchRow('sklady_id = ' . $id)->nazov_skladu;
        return $nazov;

    }

    //vracanie názvov pre výpisy
    public function getSkratka($id)
    {
        $id = (int)$id;
        $skratkaSkladu = $this->fetchRow('sklady_id = ' . $id)->skratka_skladu;
        return $skratkaSkladu;

    }

    //metoda vracia pole pre vypisy a formulare - id a nazov skladu
    public function getMoznosti()
    {
        $pole = $this->fetchAll()->toArray();
        $moznosti = array();

        foreach ($pole as $hodnota) {
            $moznosti[$hodnota['sklady_id']] = $hodnota['nazov_skladu'];
        }

        return $moznosti;
    }

    public function getIds()
    {
        $sklady = $this->fetchAll()->toArray();
        $ids = array();

        foreach ($sklady as $sklad) {
            $ids[] = $sklad['sklady_id'];
        }
        return $ids;
    }

    public function getMernaJednotka($idSkladu)
    {
        $sql = "sklady_id = " . $idSkladu;
        $sklady = $this->fetchAll($sql)->toArray();
        return $sklady[0]['merna_jednotka_enum'];
    }

    public function getMernaJednotkaSkratka($idSkladu)
    {
        $merneJednotky = new Application_Model_DbTable_MerneJednotky();
        $sql = "sklady_id = " . $idSkladu;
        $sklady = $this->fetchAll($sql)->toArray();
        $skratka = $merneJednotky->getSkratka($sklady[0]['merna_jednotka_enum']);
        return $skratka;
    }

}