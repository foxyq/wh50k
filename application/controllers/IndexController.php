<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $_SESSION['pomoc'] = "mala macinka";
    }

    public function indexAction()
    {
        // action body
        /*$merneJednotky = new Application_Model_DbTable_MerneJednotky();
        $prepocet = $merneJednotky->getPrepocitaneJednotky(15, 2, 2);
        $prijmy = new Application_Model_DbTable_Prijmy();
        $this->view->prepocet = $prepocet;
        $this->view->status = $this->getStatus();*/

        //$form = $this->view->form = new Application_Form_Login();
        $request = $this->getRequest()->getServer('HTTP_REFERER');
        //$request->getHeader('referer');
        //print_r( $request);
    }

    public function previewAction()
    {
        // action body
        /*
        $prijmy = new Application_Model_DbTable_Prijmy();
        $sklady = new Application_Model_DbTable_Sklady();

        $podsklady = new Application_Model_DbTable_Podsklady();
        $dodavatelia = new Application_Model_DbTable_Dodavatelia();
        $prepravci = new Application_Model_DbTable_Prepravci();


        $this->view->prijmy = $prijmy->fetchAll();
        $this->view->sklady = $sklady;
        
        $this->view->podsklady = $podsklady;
        $this->view->dodavatelia = $dodavatelia;
        $this->view->prepravci = $prepravci;
        */
    }

    private function getStatus()
    {
        $status = array();

        $prijmy = new Application_Model_DbTable_Prijmy();
        $vydaje = new Application_Model_DbTable_Vydaje();

        $status['prijmy_waitings'] = $prijmy->getNumberOfWaitings();
        $status['prijmy_errors'] = $prijmy->getNumberOfErrors();
        $status['vydaje_waitings'] = $vydaje->getNumberOfWaitings();
        $status['vydaje_errors'] = $vydaje->getNumberOfErrors();

        return $status;


    }

    /*public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('/');

    }*/

    public function hashAction()
    {

        $form = $this->view->form = new Application_Form_Login();
        if ($this->getRequest()->isPost()
            && $form->isValid($this->getRequest()->getPost())
        ) {
            $adapter = new Zend_Auth_Adapter_DbTable(
                Zend_Db_Table_Abstract::getDefaultAdapter(),
                'users_v02',
                'email',
                'password',
                'SHA1(?)'
            );
            $adapter->setIdentity($form->getValue('email'));
            $adapter->setCredential($form->getValue('password'));

            $result = Zend_Auth::getInstance()->authenticate($adapter);
            if (!$result->isValid()) {
                d($result->getMessages());
            } else {
                $this->_redirect('/');
            }
        }

    }

    /*
    public function moreAction()
    {
        $form = $this->view->form = new Application_Form_Login();
        if ($this->getRequest()->isPost()
            && $form->isValid($this->getRequest()->getPost())
        ) {
            $adapter = new Zend_Auth_Adapter_DbTable(
                Zend_Db_Table_Abstract::getDefaultAdapter(),
                'users_v02',
                'email',
                'password',
                'SHA1(?)'
            );
            $adapter->setIdentity($form->getValue('email'));
            $adapter->setCredential($form->getValue('password'));

            $result = Zend_Auth::getInstance()->authenticate($adapter);
            if (!$result->isValid()) {
                d($result->getMessages());
            } else {
                $storage = Zend_Auth::getInstance()->getStorage();
                $storage->write(
                    $adapter->getResultRowObject(
                        array('email', 'name')
                    )
                );
                $this->_redirect('/');
            }
        }
    }*/

    public function secretAction()
    {
        print_r($_SESSION['pomoc']);
        $request = $this->getRequest()->getServer('HTTP_REFERER');
        //$request->getHeader('referer');
        print_r( $request);
    }


}









