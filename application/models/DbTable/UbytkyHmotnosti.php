<?php

class Application_Model_DbTable_UbytkyHmotnosti extends Zend_Db_Table_Abstract
{

    protected $_name = 'ts_ubytky_hmotnosti';

    //vymaze vsetky data v tabulke
    public function dropTableData(){
        $this->delete(1);
    }

    //vymaze vsetky data v tabulke od datumu do datumu
    private function dropTableDataByDate($dateFrom, $dateTo){
        $sql = "datum_ubytku_d BETWEEN '".$dateFrom."' AND '".$dateTo."'";
        $this->delete($sql);

    }

    //Tato metoda vyhradi vypocita vsetky data v tabulke ubytky hmotnosti od datumu $start do datumu $end
    private function calculateTableData($start, $end){
        $startDate = new DateTime($start);
        $endDate = new DateTime($end);


        $prijmy = new Application_Model_DbTable_Prijmy();
        $vydaje = new Application_Model_DbTable_Vydaje();
        $sklady = new Application_Model_DbTable_Sklady();
        $parametreUbytkov = new Application_Model_DbTable_UbytkyParametre();

        $skladyIds = $sklady->getIds();
        $id = 1;

        foreach ($skladyIds AS $skladId){
            $date = new DateTime($start);
            do {
                if ($date == $startDate){
                    $stavRano = 0;
                }
                $prijem = $prijmy->getSumByDateAndStock('q_tony_merane', 'datum_prijmu_d', $date->format('Y-m-d'), 'sklad_enum', $skladId);
                $vydaj = $vydaje->getSumByDateAndStock('q_tony_merane', 'datum_vydaju_d', $date->format('Y-m-d'), 'sklad_enum', $skladId);
                $parameterUbytku = $parametreUbytkov->getParameter($date->format('Y-m-d'));
                $dennyPohyb = $prijem - $vydaj;
                $stavVecer = $stavRano + $dennyPohyb;
                if($stavVecer < 0)
                {
                    $stavVecer = 0;
                    $poznamka = 'Nedostatok na sklade.';
                }
                $stavCelyDen = min($stavRano, $stavVecer);
                $ubytok = $stavCelyDen * $parameterUbytku;
                $konecnyStav = $stavVecer - $ubytok;

                $this->insert(array
                (
                    'ts_ubytky_hmotnosti_id' => $id,
                    'datum_ubytku_d' => $date->format('Y-m-d'),
                    'sklad_enum' => $skladId,
                    'q_rano_tony' => $stavRano,
                    'q_denny_pohyb_tony' => $dennyPohyb,
                    'q_vecer_tony' => $stavVecer,
                    'q_cely_den_tony' => $stavCelyDen,
                    'q_ubytok_tony' => $ubytok,
                    'q_konecny_stav_tony' => $konecnyStav,
                    'poznamka' => $poznamka
                ));

                $date->modify('+1 day');
                $id++;
                $stavRano = $konecnyStav;
                $poznamka = null;
            }
            while ($endDate>=$date);
        }

    }

    //matoda, ktora spusti refresh celej tabulky -dropData, calculateData podla datum od $startDate do $endDate
    public function refreshTableDataByDate($startDate, $endDate){
        $this->dropTableData();
        $this->calculateTableData($startDate,$endDate);

    }

    public function getLastStavSkladu($skladId){
        $transakcie = $this->fetchAll("sklad_enum = ".$skladId)->toArray();
        $lastElement = end($transakcie);
        return $lastElement['q_konecny_stav_tony'];
    }









}

