<?php

class Application_Model_DbTable_Zakaznici extends Zend_Db_Table_Abstract
{

    protected $_name = 'zakaznici';

    public function getZakaznik($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('zakaznici_id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    //vracanie názvov pre výpisy
    public function getNazov($id)
    {
        $id = (int)$id;
        $nazov = $this->fetchRow('zakaznici_id = '.$id)->nazov_spolocnosti;
        return $nazov;
    }

    public function addZakaznik($meno, $nazov_spolocnosti)
    {
        $data = array(
            'meno' => $meno,
            'nazov_spolocnosti' => $nazov_spolocnosti,
        );
        $this->insert($data);
    }

    public function deleteZakaznik($id)
    {
        $this->delete('zakaznici_id =' . (int)$id);
    }

    public function updateZakaznik($id, $meno, $nazov_spolocnosti)
    {
        $data = array(
            'meno' => $meno,
            'nazov_spolocnosti' => $nazov_spolocnosti,
        );
        $this->update($data, 'zakaznici_id = '. (int)$id);
    }





}

