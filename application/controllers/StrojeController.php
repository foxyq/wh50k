<?php

class StrojeController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        $strojeTypyMoznosti = new Application_Model_DbTable_StrojeTypy();

        $strojeTypyMoznosti = $strojeTypyMoznosti->getMoznosti();

        $form = new Application_Form_Stroj(array(
            'strojeTypyMoznosti' => $strojeTypyMoznosti));

        $form->submit->setLabel('Pridať stroj');

        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $nazov_stroja = $form->getValue('nazov_stroja');
                $typ_stroja= $form->getValue('typ_stroja');
                $stroje = new Application_Model_DbTable_Stroje();
                $stroje->addStroj($nazov_stroja, $typ_stroja);

                $this->_helper->redirector('list');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function listAction()
    {
        $stroje = new Application_Model_DbTable_Stroje();
        $strojeTypy = new Application_Model_DbTable_StrojeTypy();

        $this->view->stroje = $stroje->fetchAll();
        $this->view->strojeTypy = $strojeTypy;

        $this->view->title = "Stroje - zoznam";
    }

    public function editAction()
    {
         {
            $strojeTypyMoznosti = new Application_Model_DbTable_StrojeTypy();
            $strojeTypyMoznosti = $strojeTypyMoznosti->getMoznosti();


            $form = new Application_Form_Stroj(array(
            'strojeTypyMoznosti' => $strojeTypyMoznosti));
            $form->submit->setLabel('Uložiť');
            $this->view->form = $form;

            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
                    $id = (int)$form->getValue('stroje_id');
                    $nazov = $form->getValue('nazov_stroja');
                    $typ = $form->getValue('typ_stroja');
                    $stroje = new Application_Model_DbTable_Stroje();
                    $stroje->updateStroj($id, $nazov, $typ);

                    $this->_helper->redirector('list');
                } else {
                    $form->populate($formData);
                }
            } else {
                $id = $this->_getParam('id', 0);
                if ($id > 0) {
                    $stroje= new Application_Model_DbTable_Stroje();
                    $form->populate($stroje->getStroj($id));
                }
            }
        }
    }


}







