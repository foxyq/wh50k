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

        $this->view->skladyModel = $sklady;
        $this->view->sklady = $sklady->fetchAll();
        $this->view->skladyModel = $sklady;
        $this->view->prijmy = $prijmy;
        $this->view->vydaje = $vydaje;
        $this->view->ubytky = $ubytky;

        //vypocty pre pohyby
        $pohyby = array();
        $skladyIdArray = $sklady->getIds();

        foreach ($skladyIdArray as $skladId)
        {
            switch ($sklady->getMernaJednotka($skladId))
            {
                case 1:
                    $stlpec = 'q_tony_merane';
                    break;
                case 2:
                    $stlpec = 'q_prm_merane';
                    break;
                case 3:
                    $stlpec = 'q_m3_merane';
                    break;
            }

            //den
            $pohyby[$skladId]['den']['prijmy'] = $prijmy->getSumByDateAndStock($stlpec, "sklad_enum", $skladId, "datum_prijmu_d", "'".date('Y-m-d')."'");
            $pohyby[$skladId]['den']['vydaje'] = $vydaje->getSumByDateAndStock($stlpec, "sklad_enum", $skladId, "datum_vydaju_d", "'".date('Y-m-d')."'");
            $pohyby[$skladId]['den']['total'] = $pohyby[$skladId]['den']['prijmy'] - $pohyby[$skladId]['den']['vydaje'];

            //tyzden
            $pohyby[$skladId]['tyzden']['prijmy'] = $prijmy->getSubmittedSumByColumnBetween($stlpec, "datum_prijmu_d", date('Y-m-d', strtotime('-7 days')), date('Y-m-d'), "sklad_enum", $skladId);
            $pohyby[$skladId]['tyzden']['vydaje'] = $vydaje->getSubmittedSumByColumnBetween($stlpec, "datum_vydaju_d", date('Y-m-d', strtotime('-7 days')), date('Y-m-d'), "sklad_enum", $skladId);
            $pohyby[$skladId]['tyzden']['total'] = $pohyby[$skladId]['tyzden']['prijmy'] - $pohyby[$skladId]['tyzden']['vydaje'];


            //mesiac
            $pohyby[$skladId]['mesiac']['prijmy'] = $prijmy->getSubmittedSumByColumnBetween($stlpec, "datum_prijmu_d", date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), "sklad_enum", $skladId);
            $pohyby[$skladId]['mesiac']['vydaje'] = $vydaje->getSubmittedSumByColumnBetween($stlpec, "datum_vydaju_d", date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), "sklad_enum", $skladId);
            $pohyby[$skladId]['mesiac']['total'] = $pohyby[$skladId]['mesiac']['prijmy'] - $pohyby[$skladId]['mesiac']['vydaje'];
        }

        $this->view->pohyby = $pohyby;

        //vypocet pre grafy
        $vyvojStavuSkladov = array();
        foreach ($skladyIdArray as $skladId) {
            $vyvojStavuSkladov[$skladId] = $ubytky->getLastXValues($skladId, 30);
        }
        $this->view->vyvojStavuSkladov = $vyvojStavuSkladov;



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







