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

    public function addAction()
    {
        $mestaMoznosti = new Application_Model_DbTable_Mesta();
        $merneJednotkyMoznosti = new  Application_Model_DbTable_MerneJednotky();

        $mestaMoznosti = $mestaMoznosti->getMoznosti();
        $merneJednotkyMoznosti = $merneJednotkyMoznosti->getMoznosti();

        $form = new Application_Form_Sklad(array(
            'mestaMoznosti' => $mestaMoznosti,
            'merneJednotkyMoznosti' => $merneJednotkyMoznosti
        ));

        $form->submit->setLabel('Pridať sklad');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $kod = $form->getValue('kod_skladu');
                $nazov = $form->getValue('nazov_skladu');
                $skratka = $form->getValue('skratka_skladu');
                $mesto = $form->getValue('mesto_enum');
                $merna_jednotka = $form->getValue('merna_jednotka_enum');
                $adresa = $form->getValue('adresa');
                $sklady = new Application_Model_DbTable_Sklady();
                $sklady->addSklad($kod, $nazov, $skratka, $mesto, $merna_jednotka, $adresa);

                $this->_helper->redirector('list');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function listAction()
    {
        $sklady = new Application_Model_DbTable_Sklady();
        $mesta = new Application_Model_DbTable_Mesta();
        $merneJednotky = new Application_Model_DbTable_MerneJednotky();

        $this->view->sklady = $sklady->fetchAll();
        $this->view->mesta = $mesta;
        $this->view->merneJednotky = $merneJednotky;

        $this->view->title = "Sklady - zoznam";
    }

    public function editAction()
    {
        {
            $mestaMoznosti = new Application_Model_DbTable_Mesta();
            $merneJednotkyMoznosti = new  Application_Model_DbTable_MerneJednotky();

            $mestaMoznosti = $mestaMoznosti->getMoznosti();
            $merneJednotkyMoznosti = $merneJednotkyMoznosti->getMoznosti();

            $form = new Application_Form_Sklad(array(
            'mestaMoznosti' => $mestaMoznosti,
            'merneJednotkyMoznosti' => $merneJednotkyMoznosti
            ));

            $form->submit->setLabel('Uložiť');
            $this->view->form = $form;
            $this->view->title = "Upraviť sklad";

            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
                    $id = (int)$form->getValue('sklady_id');
                    $kod = $form->getValue('kod_skladu');
                    $nazov = $form->getValue('nazov_skladu');
                    $skratka = $form->getValue('skratka_skladu');
                    $mesto = $form->getValue('mesto_enum');
                    $merna_jednotka = $form->getValue('merna_jednotka_enum');
                    $adresa = $form->getValue('adresa');

                    $sklady = new Application_Model_DbTable_Sklady();
                    $sklady->updateSklad($id, $kod, $nazov, $skratka, $mesto, $merna_jednotka, $adresa);

                    $this->_helper->redirector('list');
                } else {
                    $form->populate($formData);
                }
            } else {
                $id = $this->_getParam('id', 0);
                if ($id > 0) {
                    $sklady= new Application_Model_DbTable_Sklady();
                    $form->populate($sklady->getSklad($id));
                }
            }
        }
    }


}







