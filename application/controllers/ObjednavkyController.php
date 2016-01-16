<?php

class ObjednavkyController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function listAction()
    {
        $objednavky = new Application_Model_DbTable_Objednavky();
        $zakazniciModel = new Application_Model_DbTable_Zakaznici();
        $merneJednotkyModel = new Application_Model_DbTable_MerneJednotky();

        $this->view->objednavky = $objednavky->fetchAll();
        $this->view->zakazniciModel = $zakazniciModel;
        $this->view->merneJednotkyModel = $merneJednotkyModel;

        $this->view->title = "Objednávky - zoznam";

    }


}



