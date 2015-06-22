<?php

class VydajeController extends Zend_Controller_Action
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
        // vytvorenie instancií modelov
        $vydaje = new Application_Model_DbTable_Vydaje();
        $sklady = new Application_Model_DbTable_Sklady();
        $podsklady = new Application_Model_DbTable_Podsklady();
        $zakaznici = new Application_Model_DbTable_Zakaznici();
        $prepravci = new Application_Model_DbTable_Prepravci();

        // priradenie modelov do premenných a poslanie na view script
        $this->view->vydaje = $vydaje->fetchAll();
        $this->view->sklady = $sklady;
        $this->view->podsklady = $podsklady;
        $this->view->zakaznici = $zakaznici;
        $this->view->prepravci = $prepravci;

        //názov stránky
        $this->view->title = "Výdaje - zoznam";
    }


    public function addAction()
    {
        $form = new Application_Form_Vydaj();

        $form->submit->setLabel('Pridať výdaj');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();

            //echo $form->getAttribs();

            if ($form->isValid($formData)) {
//                $meno = $form->getValue('meno');

              $vydaje = new Application_Model_DbTable_Vydaje();
              $vydaje->addVydaj($formData);

//                TOTO vymazat z form data submit a tak to ulozic

                //echo $form->getValues($data);
//                echo $form->getValue('datum_vydaju_d');


//                $this->_helper->redirector('list');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function editAction()
    {
        // action body
    }

    public function deleteAction()
    {
     if ($this->getRequest()->isPost()) {
        $del = $this->getRequest()->getPost('del');
        if ($del == 'Yes') {
            $id = $this->getRequest()->getPost('ts_vydaje_id');
            $vydaje = new Application_Model_DbTable_Vydaje();
            $vydaje->deleteVydaj($id);
        }
         $this->_helper->redirector('list');
            } else {
                $id = $this->_getParam('ts_vydaje_id', 0);
                $vydaje = new Application_Model_DbTable_Vydaje();
                $this->view->vydaj = $vydaje->getVydaj($id);
            }
    }




}









