<?php

class Skladnik_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $prijmy = new Application_Model_DbTable_Prijmy();
        $prijmy = $prijmy->getNumberOfErrors();

        $this->view->prijmy = $prijmy;
    }

    public function secretAction()
    {
        // action body
    }


}



