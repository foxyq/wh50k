<?php

class SkladyController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $sklady = new Application_Model_DbTable_Sklady();
        $prijmy = new Application_Model_DbTable_Prijmy();
        $vydaje = new Application_Model_DbTable_Vydaje();
        $ubytky = new Application_Model_DbTable_UbytkyHmotnosti();

        $this->view->sklady = $sklady->fetchAll();
        $this->view->skladyModel = $sklady;
        $this->view->prijmy = $prijmy;
        $this->view->vydaje = $vydaje;
        $this->view->ubytky = $ubytky;
    }


}

