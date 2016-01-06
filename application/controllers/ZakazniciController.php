<?php

class ZakazniciController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function indexAction()
    {
        $zakaznici = new Application_Model_DbTable_Zakaznici();
        $vydaje = new Application_Model_DbTable_Vydaje();

        $zakazniciIds = $zakaznici->getIds();
        $dodaneMnozstvoZakaznikom = array();

        foreach ($zakazniciIds AS $zakaznikId){

            $dodaneMnozstvoZakaznikom[$zakaznikId]['nazov'] = $zakaznici->getNazov($zakaznikId);
            $dodaneMnozstvoZakaznikom[$zakaznikId]['q_tony_merane'] = $vydaje->getSumByColumn('q_tony_merane', 'zakaznik_enum', $zakaznikId);

        }

        $this->view->title = "Zákazníci - prehľad";
        $this->view->dodaneMnozstvoZakaznikom = $dodaneMnozstvoZakaznikom;
        $this->view->zakazniciModel = $zakaznici;
    }

    public function addAction()
    {

        $merneJednotkyMoznosti = new  Application_Model_DbTable_MerneJednotky();
        $merneJednotkyMoznosti = $merneJednotkyMoznosti->getMoznosti();

        $form = new Application_Form_Zakaznik(array(
            'merneJednotkyMoznosti' => $merneJednotkyMoznosti
        ));


        $form->submit->setLabel('Pridať zákanzíka');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $meno = $form->getValue('meno');
                $nazov_spolocnosti= $form->getValue('nazov_spolocnosti');
                $merna_jednotka= $form->getValue('merna_jednotka_enum');
                $zakaznici = new Application_Model_DbTable_Zakaznici();
                $zakaznici->addZakaznik($meno, $nazov_spolocnosti, $merna_jednotka);

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

        $merneJednotky = new Application_Model_DbTable_MerneJednotky();
        $this->view->merneJednotky = $merneJednotky;

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
            $merneJednotkyMoznosti = new  Application_Model_DbTable_MerneJednotky();
            $merneJednotkyMoznosti = $merneJednotkyMoznosti->getMoznosti();

            $form = new Application_Form_Zakaznik(array(
            'merneJednotkyMoznosti' => $merneJednotkyMoznosti
            ));

            $form->submit->setLabel('Uložiť');
            $this->view->form = $form;

            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
                    $id = (int)$form->getValue('zakaznici_id');
                    $meno = $form->getValue('meno');
                    $nazov_spolocnosti = $form->getValue('nazov_spolocnosti');
                    $merna_jednotka= $form->getValue('merna_jednotka_enum');
                    $zakaznici = new Application_Model_DbTable_Zakaznici();
                    $zakaznici->updateZakaznik($id, $meno, $nazov_spolocnosti, $merna_jednotka);

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









