<?php

class Application_Model_DbTable_Stroje extends Zend_Db_Table_Abstract
{

    protected $_name = 'stroje';

    public function getStroj($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('stroje_id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function getIds()
    {
        $stroje = $this->fetchAll()->toArray();
        $ids = array();

        foreach ($stroje as $stroj) {
            $ids[] = $stroj['stroje_id'];
        }
        return $ids;
    }

    public function getNazov($id)
    {
        $id = (int)$id;
        $nazov = $this->fetchRow('stroje_id = ' . $id)->nazov_stroja;
        return $nazov;

    }

    public function getTyp($id)
    {
        $id = (int)$id;
        $typ = $this->fetchRow('stroje_id = ' . $id)->typ_stroja;
        return $typ;

    }

    public function addStroj($nazov, $typ)
    {
        $data = array(
            'nazov_stroja' => $nazov,
            'typ_stroja' => $typ,
        );
        $this->insert($data);
    }

    public function updateStroj($id, $nazov, $typ)
    {
        $data = array(
            'nazov_stroja' => $nazov,
            'typ_stroja' => $typ,
        );
        $this->update($data, 'stroje_id = '. (int)$id);
    }


}

