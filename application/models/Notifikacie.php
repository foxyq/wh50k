<?php

class Application_Model_Notifikacie
{

    public function getStatusArray(){
        $status = array();

        $prijmy = new Application_Model_DbTable_Prijmy();
        $vydaje = new Application_Model_DbTable_Vydaje();


        $status['prijmy_waitings'] = $prijmy->getNumberOfWaitings();
        $status['prijmy_errors'] = $prijmy->getNumberOfErrors();
        $status['vydaje_waitings'] = $vydaje->getNumberOfWaitings();
        $status['vydaje_errors'] = $vydaje->getNumberOfErrors();


        $status['total'] = $prijmy->getNumberOfWaitings() + $prijmy->getNumberOfErrors() + $vydaje->getNumberOfWaitings() + $vydaje->getNumberOfErrors();

        return $status;


    }

    //vracia iba cislo - pocet notifikacii
    public function getStatusTotal(){
        $statusArray = $this->getStatusArray();
        $statusCount = $statusArray['total'];
        return $statusCount;
    }


}

