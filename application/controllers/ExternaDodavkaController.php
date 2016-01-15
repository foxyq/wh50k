<?php

class ExternaDodavkaController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
    }

    public function indexAction()
    {
        // action body
    }

    public function listAction()
    {
        // vytvorenie instancií modelov
        $externeDodavky = new Application_Model_DbTable_ExternaDodavka();
        $zakaznici = new Application_Model_DbTable_Zakaznici();
        $prepravci = new Application_Model_DbTable_Prepravci();
        $materialyTypy = new Application_Model_DbTable_MaterialyTypy();
        $materialyDruhy = new Application_Model_DbTable_MaterialyDruhy();
        $transakcieStavy = new Application_Model_DbTable_TransakcieStavy();

        // priradenie modelov do premenných a poslanie na view script
        $param = $this->_getParam('param', null);
        $title = $this->_getParam('title', null);
        if (!isset($title)){$title = 'Externé dodávky - zoznam';}

        // priradenie modelov do premenných a poslanie na view script
        $this->view->externeDodavky = $externeDodavky->fetchAll($param);
        $this->view->zakaznici = $zakaznici;
        $this->view->prepravci = $prepravci;
        $this->view->materialyTypy = $materialyTypy;
        $this->view->materialyDruhy = $materialyDruhy;
        $this->view->transakcieStavy = $transakcieStavy;

        //názov stránky
        $this->view->title = "Externá dodávka - zoznam";
    }

    public function waitingsAction()
    {
        // vytvorenie instancií modelov
        $externeDodavky = new Application_Model_DbTable_ExternaDodavka();
        $zakaznici = new Application_Model_DbTable_Zakaznici();
        $prepravci = new Application_Model_DbTable_Prepravci();
        $materialyTypy = new Application_Model_DbTable_MaterialyTypy();
        $materialyDruhy = new Application_Model_DbTable_MaterialyDruhy();
        $transakcieStavy = new Application_Model_DbTable_TransakcieStavy();

        // priradenie modelov do premenných a poslanie na view script
        //$param = $this->_getParam('param', null);
        //$title = $this->_getParam('title', null);
        //if (!isset($title)){$title = 'Externé dodávky - zoznam';}

        // priradenie modelov do premenných a poslanie na view script
        $this->view->externeDodavky = $externeDodavky->fetchAll("stav_transakcie = 1");
        $this->view->zakaznici = $zakaznici;
        $this->view->prepravci = $prepravci;
        $this->view->materialyTypy = $materialyTypy;
        $this->view->materialyDruhy = $materialyDruhy;
        $this->view->transakcieStavy = $transakcieStavy;

        //názov stránky
        $this->view->title = "Externá dodávka - čaká na schválenie";
    }

    public function errorsAction()
    {

        // vytvorenie instancií modelov
        $externeDodavky = new Application_Model_DbTable_ExternaDodavka();
        $zakaznici = new Application_Model_DbTable_Zakaznici();
        $prepravci = new Application_Model_DbTable_Prepravci();
        $materialyTypy = new Application_Model_DbTable_MaterialyTypy();
        $materialyDruhy = new Application_Model_DbTable_MaterialyDruhy();
        $transakcieStavy = new Application_Model_DbTable_TransakcieStavy();

        // priradenie modelov do premenných a poslanie na view script
        //$param = $this->_getParam('param', null);
        //$title = $this->_getParam('title', null);
        //if (!isset($title)){$title = 'Externé dodávky - zoznam';}

        // priradenie modelov do premenných a poslanie na view script
        $this->view->externeDodavky = $externeDodavky->fetchAll("chyba = 1");
        $this->view->zakaznici = $zakaznici;
        $this->view->prepravci = $prepravci;
        $this->view->materialyTypy = $materialyTypy;
        $this->view->materialyDruhy = $materialyDruhy;
        $this->view->transakcieStavy = $transakcieStavy;

        //názov stránky
        $this->view->title = "Externá dodávka - chyby";
    }


}







