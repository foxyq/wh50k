<?php

class MaterialyTypyController extends Zend_Controller_Action
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
        $materialyTypy = new Application_Model_DbTable_MaterialyTypy();

        $this->view->materialyTypy = $materialyTypy->fetchAll();

        $this->view->title = "Typy materiálov - zoznam";
    }


}



