<?php

class VydajeController extends Zend_Controller_Action
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
        $vydaje = new Application_Model_DbTable_Vydaje();
        $sklady = new Application_Model_DbTable_Sklady();
        $podsklady = new Application_Model_DbTable_Podsklady();
        $zakaznici = new Application_Model_DbTable_Zakaznici();
        $prepravci = new Application_Model_DbTable_Prepravci();
        $materialyTypy = new Application_Model_DbTable_MaterialyTypy();
        $materialyDruhy = new Application_Model_DbTable_MaterialyDruhy();
        $transakcieStavy = new Application_Model_DbTable_TransakcieStavy();

        // priradenie modelov do premenných a poslanie na view script
        $this->view->vydaje = $vydaje->fetchAll();
        $this->view->sklady = $sklady;
        $this->view->podsklady = $podsklady;
        $this->view->zakaznici = $zakaznici;
        $this->view->prepravci = $prepravci;
        $this->view->materialyTypy = $materialyTypy;
        $this->view->materialyDruhy = $materialyDruhy;
        $this->view->transakcieStavy = $transakcieStavy;

        //názov stránky
        $this->view->title = "Výdaje - zoznam";
    }

    public function addAction()
    {

        //instancia modelu z ktoreho budeme tahat zoznam
        $skladyMoznosti = new Application_Model_DbTable_Sklady();
        $podskladyMoznosti = new Application_Model_DbTable_Podsklady();
        $zakazniciMoznosti = new Application_Model_DbTable_Zakaznici();
        $prepravciMoznosti = new Application_Model_DbTable_Prepravci();
        $dokladyTypyMoznosti = new Application_Model_DbTable_DokladyTypy();
        $materialyDruhy = new Application_Model_DbTable_MaterialyDruhy();
        $materialyTypy = new Application_Model_DbTable_MaterialyTypy();
        $transakcieStavy = new Application_Model_DbTable_TransakcieStavy();

        //metoda ktorou vytiahneme do premennej zoznam
        $skladyMoznosti = $skladyMoznosti->getMoznosti();
        $podskladyMoznosti = $podskladyMoznosti->getMoznosti();
        $zakazniciMoznosti = $zakazniciMoznosti->getMoznosti();
        $prepravciMoznosti = $prepravciMoznosti->getMoznosti();
        $dokladyTypyMoznosti = $dokladyTypyMoznosti->getMoznosti();
        $materialyDruhyMoznosti = $materialyDruhy->getMoznosti();
        $materialyTypyMoznosti = $materialyTypy->getMoznosti();
        $transakcieStavyMoznosti = $transakcieStavy->getMoznosti();


        //samostatne premenne ktore posielame na form
        $potvrdzujuceTlacidlo = 'Vložiť';

        $form = new Application_Form_Vydaj(array(
            'skladyMoznosti' => $skladyMoznosti,
            'podskladyMoznosti' => $podskladyMoznosti,
            'zakazniciMoznosti' => $zakazniciMoznosti,
            'prepravciMoznosti' => $prepravciMoznosti,
            'dokladyTypyMoznosti' => $dokladyTypyMoznosti,
            'materialyDruhyMoznosti' => $materialyDruhyMoznosti,
            'materialyTypyMoznosti' => $materialyTypyMoznosti,
            'transakcieStavyMoznosti' => $transakcieStavyMoznosti,
            'potvrdzujuceTlacidlo' => $potvrdzujuceTlacidlo
        ));

        $this->view->form = $form;


        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();

//            var_dump($this->getRequest()->getPost());

            if ($form->isValid($formData)) {

                $datum_vydaju = $form->getValue('datum_vydaju_d');
                $sklad = $form->getValue('sklad_enum');
                $podsklad = $form->getValue('podsklad_enum');
                $zakaznik = $form->getValue('zakaznik_enum');
                $prepravca = $form->getValue('prepravca_enum');
                $prepravca_spz = $form->getValue('prepravca_spz');
                $q_tony_merane = $form->getValue('q_tony_merane');
                $doklad_typ = $form->getValue('doklad_typ_enum');
                $material_typ = $form->getValue('material_typ_enum');
                $material_druh = $form->getValue('material_druh_enum');
                $poznamka = $form->getValue('poznamka');
                $chyba = $form->getValue('chyba');
                $stav_transakcie = $form->getValue('stav_transakcie');

                $vydaje = new Application_Model_DbTable_Vydaje();

                $vydaje->addVydaj(
                    $datum_vydaju,
                    $sklad,
                    $podsklad,
                    $zakaznik,
                    $prepravca,
                    $prepravca_spz,
                    $q_tony_merane,
                    $doklad_typ,
                    $material_typ,
                    $material_druh,
                    $poznamka,
                    $chyba,
                    $stav_transakcie);

                $this->_helper->redirector('list');


            } else {
                $form->populate($formData);
            }
        }
    }

    public function editAction()
    {

        //instancia modelu z ktoreho budeme tahat zoznam
        $skladyMoznosti = new Application_Model_DbTable_Sklady();
        $podskladyMoznosti = new Application_Model_DbTable_Podsklady();
        $zakazniciMoznosti = new Application_Model_DbTable_Zakaznici();
        $prepravciMoznosti = new Application_Model_DbTable_Prepravci();
        $dokladyTypyMoznosti = new Application_Model_DbTable_DokladyTypy();
        $materialyDruhy = new Application_Model_DbTable_MaterialyDruhy();
        $materialyTypy = new Application_Model_DbTable_MaterialyTypy();
        $transakcieStavy = new Application_Model_DbTable_TransakcieStavy();

        //metoda ktorou vytiahneme do premennej zoznam
        $skladyMoznosti = $skladyMoznosti->getMoznosti();
        $podskladyMoznosti = $podskladyMoznosti->getMoznosti();
        $zakazniciMoznosti = $zakazniciMoznosti->getMoznosti();
        $prepravciMoznosti = $prepravciMoznosti->getMoznosti();
        $dokladyTypyMoznosti = $dokladyTypyMoznosti->getMoznosti();
        $materialyDruhyMoznosti = $materialyDruhy->getMoznosti();
        $materialyTypyMoznosti = $materialyTypy->getMoznosti();
        $transakcieStavyMoznosti = $transakcieStavy->getMoznosti();


        //samostatne premenne ktore posielame na form
        $potvrdzujuceTlacidlo = 'Vložiť';


        $form = new Application_Form_Vydaj(array(
            'skladyMoznosti' => $skladyMoznosti,
            'podskladyMoznosti' => $podskladyMoznosti,
            'zakazniciMoznosti' => $zakazniciMoznosti,
            'prepravciMoznosti' => $prepravciMoznosti,
            'dokladyTypyMoznosti' => $dokladyTypyMoznosti,
            'materialyDruhyMoznosti' => $materialyDruhyMoznosti,
            'materialyTypyMoznosti' => $materialyTypyMoznosti,
            'transakcieStavyMoznosti' => $transakcieStavyMoznosti,
            'potvrdzujuceTlacidlo' => $potvrdzujuceTlacidlo
        ));


        $this->view->form = $form;


        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            print_r($formData);

            if ($form->isValid($formData)) {

                $id = (int)$form->getValue('ts_vydaje_id');
                $datum_vydaju = $form->getValue('datum_vydaju_d');
                $sklad = $form->getValue('sklad_enum');
                $podsklad = $form->getValue('podsklad_enum');
                $zakaznik = $form->getValue('zakaznik_enum');
                $prepravca = $form->getValue('prepravca_enum');
                $prepravca_spz = $form->getValue('prepravca_spz');
                $q_tony_merane = $form->getValue('q_tony_merane');
                $doklad_typ = $form->getValue('doklad_typ_enum');
                $material_typ = $form->getValue('material_typ_enum');
                $material_druh = $form->getValue('material_druh_enum');
                $poznamka = $form->getValue('poznamka');
                $chyba = $form->getValue('chyba');
                $stav_transakcie = $form->getValue('stav_transakcie');

                $vydaje = new Application_Model_DbTable_Vydaje();
                $vydaje->editVydaj(
                    $id,
                    $datum_vydaju,
                    $sklad,
                    $podsklad,
                    $zakaznik,
                    $prepravca,
                    $prepravca_spz,
                    $q_tony_merane,
                    $doklad_typ,
                    $material_typ,
                    $material_druh,
                    $poznamka,
                    $chyba,
                    $stav_transakcie);

                $this->_helper->redirector('list');

            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('ts_vydaje_id', 0);
            //$id = (int)$this->$form->getValue('ts_vydaje_id');
            if ($id > 0) {
                $vydaje = new Application_Model_DbTable_Vydaje();
                $form->populate($vydaje->getVydaj($id));
                $this->view->data = $vydaje->getVydaj($id);
            }

        }
    }

    public function deleteAction()
    {

        $sklady = new Application_Model_DbTable_Sklady();
        $podsklady = new Application_Model_DbTable_Podsklady();
        $zakaznici = new Application_Model_DbTable_Zakaznici();

        $this->view->sklady = $sklady;
        $this->view->podsklady = $podsklady;
        $this->view->zakaznici = $zakaznici;


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

    public function printAction()
    {
        $id = $this->_getParam('ts_vydaje_id', 0);
        $vydaje = new Application_Model_DbTable_Vydaje();
        $this->view->vydaj = $vydaje->getVydaj($id);


//        $id = $this->_getParam('ts_vydaje_id', 0);
//        $listok = $this->_getParam('cislo_listku', 0);
//        $spz = $this->_getParam('spz', 0);
//
//        echo '<br> controller ID '.$id.', cislo '.$listok.', spz '.$spz;

        // Disable the main layout renderer
//        $this->_helper->layout->disableLayout();
        // Do not even attempt to render a view
//        $this->_helper->viewRenderer->setNoRender(true);
    }


}











