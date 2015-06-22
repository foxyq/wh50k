<?php

class Application_Model_DbTable_Vydaje extends Zend_Db_Table_Abstract
{

    protected $_name = 'ts_vydaje';

    public function getVydaj($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('ts_vydaje_id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addVydaj($data)
    {


//        $data = array(
//            'vznik_zaznamu_dtm' => $array,
//            'vytvoril_u' => $array,
//            'posledna_uprava_dtm' => $array,
//            'posledna_uprava_u' => $array,
//            'datum_vydaju_d' => $array,
//            'sklad_enum' => $array,
//            'podsklad_enum' => $array,
//            'zakaznik_enum' => $array,
//            'prepravca_enum' => $array,
//            'prepravca_spz' => $array,
//            'stroj_enum' => $array,
//            'q_tony_merane_brutto' => $array,
//            'q_tony_merane_tara' => $array,
//            'q_tony_merane' => $array,
//            'q_tony_vypocet' => $array,
//            'q_m3_merane' => $array,
//            'q_m3_vypocet' => $array,
//            'q_prm_merane' => $array,
//            'q_prm_vypocet' => $array,
//            'doklad_cislo' => $array,
//            'doklad_typ_enum' => $array,
//            'material_druh_enum' => $array,
//            'poznamka' => $array,
//            'chyba' => $array,
//            'stav_transakcie' => $array
//        );
        $this->insert($data);
    }


    public function deleteVydaj($id)
    {
        $this->delete('ts_vydaje_id =' . (int)$id);
    }


}

