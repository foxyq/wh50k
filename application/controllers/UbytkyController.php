<?php

class UbytkyController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // asi netreba
        $ubytky = new Application_Model_DbTable_UbytkyHmotnosti();
        //$prijmy = new Application_Model_DbTable_Prijmy();


        //$ubytky->dropTableData();
        $ubytky->refreshTableDataByDate('2015-06-01', '2015-06-30');

    }

    public function listAction()
    {
        // action body
        $ubytky = new Application_Model_DbTable_UbytkyHmotnosti();
        $sklady = new Application_Model_DbTable_Sklady();
        $prijmy = new Application_Model_DbTable_Prijmy();

        $this->view->ubytky = $ubytky->fetchAll();
        $this->view->sklady = $sklady;
        $this->view->prijmy = $prijmy;
        $this->view->title = 'Prehľad úbytkov';
    }


}



