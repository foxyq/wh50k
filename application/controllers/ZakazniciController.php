<?php

class ZakazniciController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        $form = new Application_Form_Zakaznik();

        $form->submit->setLabel('Pridať zákanzíka');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $meno = $form->getValue('meno');
                $nazov_spolocnosti= $form->getValue('nazov_spolocnosti');
                $zakaznici = new Application_Model_DbTable_Zakaznici();
                $zakaznici->addZakaznik($meno, $nazov_spolocnosti);

                $this->_helper->redirector('list');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function listAction()
    {
        $zakaznici = new Application_Model_DbTable_Zakaznici();
        $this->view->zakaznici = $zakaznici->fetchAll();

        $this->view->title = "Zákazníci - zoznam";
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('zakaznici_id');
                $zakaznici = new Application_Model_DbTable_Zakaznici();
                $zakaznici->deleteZakaznik($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('zakaznici_id', 0);
            $zakaznici = new Application_Model_DbTable_Zakaznici();
            $this->view->zakaznik = $zakaznici->getZakaznik($id);
        }
    }

    public function editAction()
    {
        {
            $form = new Application_Form_Zakaznik();
            $form->submit->setLabel('Uložiť');
            $this->view->form = $form;

            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
                    $id = (int)$form->getValue('zakaznici_id');
                    $meno = $form->getValue('meno');
                    $nazov_spolocnosti = $form->getValue('nazov_spolocnosti');
                    $zakaznici = new Application_Model_DbTable_Zakaznici();
                    $zakaznici->updateZakaznik($id, $meno, $nazov_spolocnosti);

                    $this->_helper->redirector('list');
                } else {
                    $form->populate($formData);
                }
            } else {
                $id = $this->_getParam('id', 0);
                if ($id > 0) {
                    $zakaznici= new Application_Model_DbTable_Zakaznici();
                    $form->populate($zakaznici->getZakaznik($id));
                }
            }
        }
    }


}









