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
//        $controller = $this->getRequest()->getControllerName();
//        $action = $this->getRequest()->getActionName();
//        VERY IMPORTANT!!!!
//        if ($controller == 'Vydaje' && $action == 'add') echo 'penis';
//        else echo 'vagina';
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
        $param = $this->_getParam('param', null);
        $title = $this->_getParam('title', null);
        if (!isset($title)){$title = 'Výdaje - zoznam';}
        // priradenie modelov do premenných a poslanie na view script
        $this->view->vydaje = $vydaje->fetchAll($param);
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
        $fromAction = $this->_getParam('fromAction', 'list');
        $this->view->fromAction = $fromAction;
        $fromController = $this->_getParam('fromController', 'vydaje');
        $this->view->fromController = $fromController;


        //instancia modelu z ktoreho budeme tahat zoznam
        $skladyMoznosti = new Application_Model_DbTable_Sklady();
        $podskladyMoznosti = new Application_Model_DbTable_Podsklady();
        $zakazniciMoznosti = new Application_Model_DbTable_Zakaznici();
        $prepravciMoznosti = new Application_Model_DbTable_Prepravci();
        $dokladyTypyMoznosti = new Application_Model_DbTable_DokladyTypy();
        $materialyDruhy = new Application_Model_DbTable_MaterialyDruhy();
        $materialyTypy = new Application_Model_DbTable_MaterialyTypy();
        $transakcieStavy = new Application_Model_DbTable_TransakcieStavy();
        $stroje = new Application_Model_DbTable_Stroje();
        //metoda ktorou vytiahneme do premennej zoznam
        $skladyMoznosti = $skladyMoznosti->getMoznosti();
        $podskladyMoznosti = $podskladyMoznosti->getMoznosti();
        $zakazniciMoznosti = $zakazniciMoznosti->getMoznosti();
        $prepravciMoznosti = $prepravciMoznosti->getMoznosti();
        $dokladyTypyMoznosti = $dokladyTypyMoznosti->getMoznosti();
        $materialyDruhyMoznosti = $materialyDruhy->getMoznosti();
        $materialyTypyMoznosti = $materialyTypy->getMoznosti();
        $transakcieStavyMoznosti = $transakcieStavy->getMoznosti();
        $strojeMoznosti = $stroje->getMoznosti();
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
            'strojeMoznosti' => $strojeMoznosti,
            'potvrdzujuceTlacidlo' => $potvrdzujuceTlacidlo,
        ));
        $this->view->form = $form;
        //pageManager
        //$_SESSION[pageManager][ignore] = 1;
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
                $q_m3_merane = $form->getValue('q_m3_merane');
                $q_prm_merane = $form->getValue('q_prm_merane');
                $q_vlhkost = $form->getValue('q_vlhkost');
                $doklad_typ = $form->getValue('doklad_typ_enum');
                $material_typ = $form->getValue('material_typ_enum');
                $material_druh = $form->getValue('material_druh_enum');
                $stroj = $form->getValue('stroj_enum');
                $poznamka = $form->getValue('poznamka');
                $chyba = $form->getValue('chyba');
                $stav_transakcie = $form->getValue('stav_transakcie');
                $code = str_replace('-', '', $datum_vydaju);
                $code = substr( $code, 2);
                $doklad_cislo = 'SV'.$code.'-'.substr(uniqid(),6);
                $vydaje = new Application_Model_DbTable_Vydaje();
                $vydaje->addVydaj(
                    $datum_vydaju,
                    $sklad,
                    $podsklad,
                    $zakaznik,
                    $prepravca,
                    $prepravca_spz,
                    $q_tony_merane,
                    $q_m3_merane,
                    $q_prm_merane,
                    $q_vlhkost,
                    $doklad_typ,
                    $material_typ,
                    $material_druh,
                    $stroj,
                    $poznamka,
                    $chyba,
                    $stav_transakcie,
                    $doklad_cislo);
                //$this->_helper->redirector('list');
                //var_dump( $doklad_cislo);
                //pageManager
                //$this->_helper->redirector($_SESSION['pageManager']['lastPageParameters']['action']);
                $this->_helper->redirector($fromAction);
            } else {
                $form->populate($formData);
                //pageManager
                //$_SESSION[pageManager][ignore] = 1;
            }
        }
    }
    public function editAction()
    {
        $fromAction = $this->_getParam('fromAction', 'list');
        $this->view->fromAction = $fromAction;
        $fromController = $this->_getParam('fromController', 'vydaje');
        $this->view->fromController = $fromController;
        //instancia modelu z ktoreho budeme tahat zoznam
        $skladyMoznosti = new Application_Model_DbTable_Sklady();
        $podskladyMoznosti = new Application_Model_DbTable_Podsklady();
        $zakazniciMoznosti = new Application_Model_DbTable_Zakaznici();
        $prepravciMoznosti = new Application_Model_DbTable_Prepravci();
        $dokladyTypyMoznosti = new Application_Model_DbTable_DokladyTypy();
        $materialyDruhy = new Application_Model_DbTable_MaterialyDruhy();
        $materialyTypy = new Application_Model_DbTable_MaterialyTypy();
        $transakcieStavy = new Application_Model_DbTable_TransakcieStavy();
        $stroje = new Application_Model_DbTable_Stroje();
        //metoda ktorou vytiahneme do premennej zoznam
        $skladyMoznosti = $skladyMoznosti->getMoznosti();
        $podskladyMoznosti = $podskladyMoznosti->getMoznosti();
        $zakazniciMoznosti = $zakazniciMoznosti->getMoznosti();
        $prepravciMoznosti = $prepravciMoznosti->getMoznosti();
        $dokladyTypyMoznosti = $dokladyTypyMoznosti->getMoznosti();
        $materialyDruhyMoznosti = $materialyDruhy->getMoznosti();
        $materialyTypyMoznosti = $materialyTypy->getMoznosti();
        $transakcieStavyMoznosti = $transakcieStavy->getMoznosti();
        $strojeMoznosti = $stroje->getMoznosti();
        //samostatne premenne ktore posielame na form
        $potvrdzujuceTlacidlo = 'Upraviť';
        $form = new Application_Form_Vydaj(array(
            'skladyMoznosti' => $skladyMoznosti,
            'podskladyMoznosti' => $podskladyMoznosti,
            'zakazniciMoznosti' => $zakazniciMoznosti,
            'prepravciMoznosti' => $prepravciMoznosti,
            'dokladyTypyMoznosti' => $dokladyTypyMoznosti,
            'materialyDruhyMoznosti' => $materialyDruhyMoznosti,
            'materialyTypyMoznosti' => $materialyTypyMoznosti,
            'transakcieStavyMoznosti' => $transakcieStavyMoznosti,
            'strojeMoznosti' => $strojeMoznosti,
            'potvrdzujuceTlacidlo' => $potvrdzujuceTlacidlo
        ));
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
//            print_r($formData);
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('ts_vydaje_id');
                $datum_vydaju = $form->getValue('datum_vydaju_d');
                $sklad = $form->getValue('sklad_enum');
                $podsklad = $form->getValue('podsklad_enum');
                $zakaznik = $form->getValue('zakaznik_enum');
                $prepravca = $form->getValue('prepravca_enum');
                $prepravca_spz = $form->getValue('prepravca_spz');
                $q_tony_merane = $form->getValue('q_tony_merane');
                $q_m3_merane = $form->getValue('q_m3_merane');
                $q_prm_merane = $form->getValue('q_prm_merane');
                $q_vlhkost = $form->getValue('q_vlhkost');
                $doklad_typ = $form->getValue('doklad_typ_enum');
                $material_typ = $form->getValue('material_typ_enum');
                $material_druh = $form->getValue('material_druh_enum');
                $stroj = $form->getValue('stroj_enum');
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
                    $q_m3_merane,
                    $q_prm_merane,
                    $q_vlhkost,
                    $doklad_typ,
                    $material_typ,
                    $material_druh,
                    $stroj,
                    $poznamka,
                    $chyba,
                    $stav_transakcie);
                //pageManager
                //$this->_helper->redirector($_SESSION['pageManager']['lastPageParameters']['action']);
                $this->_helper->redirector($fromAction);
            } else {
                $form->populate($formData);
                //pageManager
                //$_SESSION[pageManager][ignore] = 1;
            }
        } else {
            $id = $this->_getParam('id', 0);
            //$id = (int)$this->$form->getValue('ts_vydaje_id');
            if ($id > 0) {
                $vydaje = new Application_Model_DbTable_Vydaje();
                $form->populate($vydaje->getVydajFormatted($id));
                $this->view->data = $vydaje->getVydaj($id);
                //pageManager
                //$_SESSION[pageManager][ignore] = 1;
            }
        }
    }
    public function deleteAction()
    {
        $fromAction = $this->_getParam('fromAction', 'list');
        $this->view->fromAction = $fromAction;
        $fromController = $this->_getParam('fromController', 'vydaje');
        $this->view->fromController = $fromController;
        //inicializacia pre vypis premennych - pre getNazov() metody
        $skladyModel = new Application_Model_DbTable_Sklady();
        $podskladyModel = new Application_Model_DbTable_Podsklady();
        $zakazniciModel = new Application_Model_DbTable_Zakaznici();
        $prepravciModel = new Application_Model_DbTable_Prepravci();
        $strojeModel = new Application_Model_DbTable_Stroje();
        $dokladyTypyModel = new Application_Model_DbTable_DokladyTypy();
        $materialyTypyModel = new Application_Model_DbTable_MaterialyTypy();
        $materialyDruhyModel = new Application_Model_DbTable_MaterialyDruhy();
        $transakcieStavyModel = new Application_Model_DbTable_TransakcieStavy();
        $ciselniky = array(
            'skladyModel' => $skladyModel,
            'podskladyModel' => $podskladyModel,
            'zakazniciModel' => $zakazniciModel,
            'prepravciModel' => $prepravciModel,
            'strojeModel'=>$strojeModel,
            'dokladyTypyModel' => $dokladyTypyModel,
            'materialyTypyModel' => $materialyTypyModel,
            'materialyDruhyModel' => $materialyDruhyModel,
            'transakcieStavyModel' => $transakcieStavyModel,
            'strojeMoznosti' => $strojeModel
        );
        $this->view->ciselniky = $ciselniky;
        $this->view->title = "Zmazať výdaj?";
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Áno') {
                $id = $this->getRequest()->getPost('ts_vydaje_id');
                $vydaje = new Application_Model_DbTable_Vydaje();
                $vydaje->deleteVydaj($id);
            }
            $this->_helper->redirector($fromAction);
            //pageManager
            //$this->_helper->redirector($_SESSION['pageManager']['lastPageParameters']['action']);
        } else {
            $id = $this->_getParam('id', 0);
            $vydaje = new Application_Model_DbTable_Vydaje();
            $this->view->vydaj = $vydaje->getVydaj($id);
            //pageManager
            //$_SESSION[pageManager][ignore] = 1;
        }
    }
    public function printAction()
    {
        $id = $this->_getParam('ts_vydaje_id', 0);
        $vydaje = new Application_Model_DbTable_Vydaje();
        $this->view->vydaj = $vydaje->getVydaj($id);

    }
    public function previewAction()
    {
        $fromAction = $this->_getParam('fromAction', 'list');
        $fromController = $this->_getParam('fromController', 'Vydaje');
        $fromId = $this->_getParam('fromId', null);
        $this->view->fromAction = $fromAction;
        $this->view->fromController = $fromController;
        $this->view->fromId = $fromId;

        $fromAction = $this->_getParam('fromAction', 'list');
        $this->view->fromAction = $fromAction;
        //inicializacia pre vypis premennych - pre getNazov() metody
        $skladyModel = new Application_Model_DbTable_Sklady();
        $podskladyModel = new Application_Model_DbTable_Podsklady();
        $zakazniciModel = new Application_Model_DbTable_Zakaznici();
        $prepravciModel = new Application_Model_DbTable_Prepravci();
        $strojeModel = new Application_Model_DbTable_Stroje();
        $dokladyTypyModel = new Application_Model_DbTable_DokladyTypy();
        $materialyTypyModel = new Application_Model_DbTable_MaterialyTypy();
        $materialyDruhyModel = new Application_Model_DbTable_MaterialyDruhy();
        $transakcieStavyModel = new Application_Model_DbTable_TransakcieStavy();
        $ciselniky = array(
            'skladyModel' => $skladyModel,
            'podskladyModel' => $podskladyModel,
            'zakazniciModel' => $zakazniciModel,
            'prepravciModel' => $prepravciModel,
            'strojeModel'=>$strojeModel,
            'dokladyTypyModel' => $dokladyTypyModel,
            'materialyTypyModel' => $materialyTypyModel,
            'materialyDruhyModel' => $materialyDruhyModel,
            'transakcieStavyModel' => $transakcieStavyModel
        );
        $id = $this->_getParam('id');
        $vydaje = new Application_Model_DbTable_Vydaje();
        $vydaj = $vydaje->getVydajByDokladCislo($id);
        $this->view->vydaj = $vydaj;
        $this->view->ciselniky = $ciselniky;
    }
    public function waitingsAction()
    {
        //$param = "stav_transakcie = 1";
        //$title = "Výdaje - čaká na schválenie";
        //$this->_forward('list', 'vydaje', null, array('param' => $param, 'title' => $title));
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
        //$param = $this->_getParam('param', null);
        //$title = $this->_getParam('title', null);
        //if (!isset($title)){$title = 'Výdaje - zoznam';}
        // priradenie modelov do premenných a poslanie na view script
        $this->view->vydaje = $vydaje->fetchAll("stav_transakcie = 1");
        $this->view->sklady = $sklady;
        $this->view->podsklady = $podsklady;
        $this->view->zakaznici = $zakaznici;
        $this->view->prepravci = $prepravci;
        $this->view->materialyTypy = $materialyTypy;
        $this->view->materialyDruhy = $materialyDruhy;
        $this->view->transakcieStavy = $transakcieStavy;
        //názov stránky
        $this->view->title = "Výdaje - čaká na schválenie";
    }
    public function errorsAction()
    {
        //$param = "chyba = 1";
        //$title = "Výdaje - chyby";
        //$this->_forward('list', 'vydaje', null, array('param' => $param, 'title' => $title));
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
        //$param = $this->_getParam('param', null);
        //$title = $this->_getParam('title', null);
        //if (!isset($title)){$title = 'Výdaje - zoznam';}
        // priradenie modelov do premenných a poslanie na view script
        $this->view->vydaje = $vydaje->fetchAll("chyba = 1");
        $this->view->sklady = $sklady;
        $this->view->podsklady = $podsklady;
        $this->view->zakaznici = $zakaznici;
        $this->view->prepravci = $prepravci;
        $this->view->materialyTypy = $materialyTypy;
        $this->view->materialyDruhy = $materialyDruhy;
        $this->view->transakcieStavy = $transakcieStavy;
        //názov stránky
        $this->view->title = "Výdaje - chyby";
    }
    public function printtonAction()
    {
        $sklady = new Application_Model_DbTable_Sklady();
        $zakaznici = new Application_Model_DbTable_Zakaznici();
        $prepravci = new Application_Model_DbTable_Prepravci();
        $materialyTypy = new Application_Model_DbTable_MaterialyTypy();
        $materialyDruhy = new Application_Model_DbTable_MaterialyDruhy();
        $uzivatelia = new Application_Model_DbTable_Users();

        $this->view->sklady = $sklady;
        $this->view->zakaznici = $zakaznici;
        $this->view->prepravci = $prepravci;
        $this->view->materialyTypy = $materialyTypy;
        $this->view->materialyDruhy = $materialyDruhy;
        $this->view->uzivatelia = $uzivatelia;

        $id = $this->_getParam('id', 0);
        $vydaje = new Application_Model_DbTable_Vydaje();
        $this->view->vydaj = $vydaje->getVydaj($id);
    }
    public function printprmAction()
    {
        $sklady = new Application_Model_DbTable_Sklady();
        $zakaznici = new Application_Model_DbTable_Zakaznici();
        $prepravci = new Application_Model_DbTable_Prepravci();
        $materialyTypy = new Application_Model_DbTable_MaterialyTypy();
        $materialyDruhy = new Application_Model_DbTable_MaterialyDruhy();
        $uzivatelia = new Application_Model_DbTable_Users();

        $this->view->sklady = $sklady;
        $this->view->zakaznici = $zakaznici;
        $this->view->prepravci = $prepravci;
        $this->view->materialyTypy = $materialyTypy;
        $this->view->materialyDruhy = $materialyDruhy;
        $this->view->uzivatelia = $uzivatelia;

        $id = $this->_getParam('id', 0);
        $vydaje = new Application_Model_DbTable_Vydaje();
        $this->view->vydaj = $vydaje->getVydaj($id);
    }
    public function printm3Action()
    {
        $sklady = new Application_Model_DbTable_Sklady();
        $zakaznici = new Application_Model_DbTable_Zakaznici();
        $prepravci = new Application_Model_DbTable_Prepravci();
        $materialyTypy = new Application_Model_DbTable_MaterialyTypy();
        $materialyDruhy = new Application_Model_DbTable_MaterialyDruhy();
        $uzivatelia = new Application_Model_DbTable_Users();

        $this->view->sklady = $sklady;
        $this->view->zakaznici = $zakaznici;
        $this->view->prepravci = $prepravci;
        $this->view->materialyTypy = $materialyTypy;
        $this->view->materialyDruhy = $materialyDruhy;
        $this->view->uzivatelia = $uzivatelia;

        $id = $this->_getParam('id', 0);
        $vydaje = new Application_Model_DbTable_Vydaje();
        $this->view->vydaj = $vydaje->getVydaj($id);
    }
}
