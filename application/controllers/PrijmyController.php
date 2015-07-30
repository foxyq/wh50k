<?php

class PrijmyController extends Zend_Controller_Action
{

    public function init()
    {
//        celkom dolezite pre jquery ...
        $this->view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
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
        $materialyTypy = new Application_Model_DbTable_MaterialyTypy();
        $materialyDruhy = new Application_Model_DbTable_MaterialyDruhy();
        $transakcieStavy = new Application_Model_DbTable_TransakcieStavy();


        // priradenie modelov do premenných a poslanie na view script

        $this->view->prijmy = $prijmy->fetchAll();
        $this->view->sklady = $sklady;        
        $this->view->podsklady = $podsklady;
        $this->view->dodavatelia = $dodavatelia;
        $this->view->prepravci = $prepravci;
        $this->view->materialyTypy = $materialyTypy;
        $this->view->materialyDruhy = $materialyDruhy;
        $this->view->transakcieStavy = $transakcieStavy;

        //názov stránky
        $this->view->title = "Príjmy - zoznam";
    }

    public function addAction()
    {
        /* ak chces pouzit vo forme zoznam z tabuliek, musis najpr vytvorit instanciu modelu
        a metodou getMoznosti dostanes do premennej pole s moznostami so strukturou id a nazov
        nasledne toto pole das do pola ktore je ako parameter pre form*/


        //instancia modelu z ktoreho budeme tahat zoznam
        $skladyMoznosti = new Application_Model_DbTable_Sklady();
        $podskladyMoznosti = new Application_Model_DbTable_Podsklady();
        $dodavateliaMoznosti = new Application_Model_DbTable_Dodavatelia();
        $prepravciMoznosti = new Application_Model_DbTable_Prepravci();
        $dokladyTypyMoznosti = new Application_Model_DbTable_DokladyTypy();
        $materialyDruhy = new Application_Model_DbTable_MaterialyDruhy();
        $materialyTypy = new Application_Model_DbTable_MaterialyTypy();
        $transakcieStavy = new Application_Model_DbTable_TransakcieStavy();

        //metoda ktorou vytiahneme do premennej zoznam
        $skladyMoznosti = $skladyMoznosti->getMoznosti();
        $podskladyMoznosti = $podskladyMoznosti->getMoznosti();
        $dodavateliaMoznosti = $dodavateliaMoznosti->getMoznosti();
        $prepravciMoznosti = $prepravciMoznosti->getMoznosti();
        $dokladyTypyMoznosti = $dokladyTypyMoznosti->getMoznosti();
        $materialyDruhyMoznosti = $materialyDruhy->getMoznosti();
        $materialyTypyMoznosti = $materialyTypy->getMoznosti();
        $transakcieStavyMoznosti = $transakcieStavy->getMoznosti();


        //samostatne premenne ktore posielame na form
        $potvrdzujuceTlacidlo = 'Vložiť';

        //vytvorime form a v paramatre mu tam posleme nase pole
        $form = new Application_Form_Prijem(array(
            'skladyMoznosti' => $skladyMoznosti,
            'podskladyMoznosti' => $podskladyMoznosti,
            'dodavateliaMoznosti' => $dodavateliaMoznosti,
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
            //tu nesmie byt $id
            if ($form->isValid($formData)) {
                $datum_prijmu = $form->getValue('datum_prijmu_d');
                $sklad = $form->getValue('sklad_enum');
                $podsklad = $form->getValue('podsklad_enum');
                $dodavatel = $form->getValue('dodavatel_enum');
                $prepravca = $form->getValue('prepravca_enum');
                $prepravca_spz = $form->getValue('prepravca_spz');
                $q_tony_merane = $form->getValue('q_tony_merane');
                $q_tony_nadrozmer = $form->getValue('q_tony_nadrozmer');
                $doklad_typ = $form->getValue('doklad_typ_enum');
                $material_typ = $form->getValue('material_typ_enum');
                $material_druh = $form->getValue('material_druh_enum');
                $poznamka = $form->getValue('poznamka');
                $chyba = $form->getValue('chyba');
                $stav_transakcie = $form->getValue('stav_transakcie');

                $code = str_replace('-', '', $datum_prijmu);
                $code = substr( $code, 2);

                $doklad_cislo = 'SP'.$code.'-'.substr(uniqid(),6);

                $prijmy = new Application_Model_DbTable_Prijmy();
                $prijmy->addPrijem(
                    $datum_prijmu,
                    $sklad,
                    $podsklad,
                    $dodavatel,
                    $prepravca,
                    $prepravca_spz,
                    $q_tony_merane,
                    $q_tony_nadrozmer,
                    $doklad_typ,
                    $material_typ,
                    $material_druh,
                    $poznamka,
                    $chyba,
                    $stav_transakcie,
                    $doklad_cislo);

//    var_dump( $doklad_cislo);

                $this->_helper->redirector('list');

                //$this->_helper->redirector('preview', 'prijmy', null, array('id' => 1));
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
        $dodavateliaMoznosti = new Application_Model_DbTable_Dodavatelia();
        $prepravciMoznosti = new Application_Model_DbTable_Prepravci();
        $dokladyTypyMoznosti = new Application_Model_DbTable_DokladyTypy();
        $materialyDruhy = new Application_Model_DbTable_MaterialyDruhy();
        $materialyTypy = new Application_Model_DbTable_MaterialyTypy();
        $transakcieStavy = new Application_Model_DbTable_TransakcieStavy();

        //metoda ktorou vytiahneme do premennej zoznam
        $skladyMoznosti = $skladyMoznosti->getMoznosti();
        $podskladyMoznosti = $podskladyMoznosti->getMoznosti();
        $dodavateliaMoznosti = $dodavateliaMoznosti->getMoznosti();
        $prepravciMoznosti = $prepravciMoznosti->getMoznosti();
        $dokladyTypyMoznosti = $dokladyTypyMoznosti->getMoznosti();
        $materialyDruhyMoznosti = $materialyDruhy->getMoznosti();
        $materialyTypyMoznosti = $materialyTypy->getMoznosti();
        $transakcieStavyMoznosti = $transakcieStavy->getMoznosti();



        //samostatne premenne ktore posielame na form
        $potvrdzujuceTlacidlo = 'Upraviť';

        //vytvorime form a v paramatre mu tam posleme nase pole
        $form = new Application_Form_Prijem(array(
            'skladyMoznosti' => $skladyMoznosti,
            'podskladyMoznosti' => $podskladyMoznosti,
            'dodavateliaMoznosti' => $dodavateliaMoznosti,
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
            //tu musi byt premenne $id pretoze podla toho on upravuje a nacitava data
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('ts_prijmy_id');
                $datum_prijmu = $form->getValue('datum_prijmu_d');
                $sklad = $form->getValue('sklad_enum');
                $podsklad = $form->getValue('podsklad_enum');
                $dodavatel = $form->getValue('dodavatel_enum');
                $prepravca = $form->getValue('prepravca_enum');
                $prepravca_spz = $form->getValue('prepravca_spz');
                $q_tony_merane = $form->getValue('q_tony_merane');
                $q_tony_nadrozmer = $form->getValue('q_tony_nadrozmer');
                $doklad_typ = $form->getValue('doklad_typ_enum');
                $material_druh = $form->getValue('material_druh_enum');
                $material_typ = $form->getValue('material_typ_enum');
                $poznamka = $form->getValue('poznamka');
                $chyba = $form->getValue('chyba');
                $stav_transakcie = $form->getValue('stav_transakcie');

//                var_dump($datum_prijmu);

                $prijmy = new Application_Model_DbTable_Prijmy();
                $prijmy->editPrijem(
                    $id,
                    $datum_prijmu,
                    $sklad,
                    $podsklad,
                    $dodavatel,
                    $prepravca,
                    $prepravca_spz,
                    $q_tony_merane,
                    $q_tony_nadrozmer,
                    $doklad_typ,
                    $material_druh,
                    $material_typ,
                    $poznamka,
                    $chyba,
                    $stav_transakcie
                );

                $this->_helper->redirector('list');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $prijmy = new Application_Model_DbTable_Prijmy();
                $form->populate($prijmy->getPrijem($id));
                $this->view->data = $prijmy->getPrijem($id);
            }
        }
    }

    public function deleteAction()
    {
        $sklady = new Application_Model_DbTable_Sklady();
        $podsklady = new Application_Model_DbTable_Podsklady();
        $this->view->sklady = $sklady;
        $this->view->podsklady = $podsklady;

        /*  kontrola ci prisiel post alebo get
            ak pride post - tak mazeme
            ak pride get - tak posielam do formulara, kde sa pytame ci skutocne vymazat
        */

        //ak pride POST
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            //ak prisiel POST a v premennej del je hodnota Yes tak zmaze
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $prijmy = new Application_Model_DbTable_Prijmy();
                $prijmy->deletePrijem($id);
            }
            //presmeruje po zmazani na stranku list
            $this->_helper->redirector('list');
        //ak pride GET tak nacita model a posle na kontrolny vypis a otazku zmazat? data zo zaznamu
        } else {
            $id = $this->_getParam('id', 0);
            $prijmy = new Application_Model_DbTable_Prijmy();
            $this->view->prijem = $prijmy->getPrijem($id);
        }
    }

    public function printAction()
    {
        $id = $this->_getParam('id', 0);
        $prijmy = new Application_Model_DbTable_Prijmy();
        $this->view->prijem = $prijmy->getPrijem($id);


    }

    public function previewAction()
    {
        $id = $this->_getParam('id');
        $prijmy = new Application_Model_DbTable_Prijmy();
        $prijem = $prijmy->getPrijemByDokladCislo($id);
        $this->view->prijem = $prijem;
    }


}















