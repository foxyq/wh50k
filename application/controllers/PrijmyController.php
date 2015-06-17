<?php

class PrijmyController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $this->view->message = 'Stránka kde sa bude zobrazovať prehľad za príjmy.';
    }

    public function listAction()
    {
        // vytvorenie instancií modelov
        $prijmy = new Application_Model_DbTable_Prijmy();
        $sklady = new Application_Model_DbTable_Sklady();
        $podsklady = new Application_Model_DbTable_Podsklady();
        $dodavatelia = new Application_Model_DbTable_Dodavatelia();
        $prepravci = new Application_Model_DbTable_Prepravci();

        // priradenie modelov do premenných a poslanie na view script
        $this->view->prijmy = $prijmy->fetchAll();
        $this->view->sklady = $sklady;        
        $this->view->podsklady = $podsklady;
        $this->view->dodavatelia = $dodavatelia;
        $this->view->prepravci = $prepravci;

        //názov stránky
        $this->view->title = "Príjmy - zoznam";
    }

    public function addAction()
    {
        // action body
        $this->view->message = "Stránka kde sa bude pridávať príjem.";
    }

    public function editAction()
    {
        // action body
        $this->view->message = "Stránka kde sa bude upravovať príjem.";
    }

    public function deleteAction()
    {
        // action body
        $this->view->message = "Stránka kde sa bude mazať príjem.";
    }


}











