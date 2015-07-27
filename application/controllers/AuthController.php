<?php

class AuthController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }



    public function loginAction()
    {
        // prihlasi s hashom
        $form = $this->view->form = new Application_Form_Login();
        $this->view->loginTitle = "Prihlásenie do aplikácie";

        $this->_helper->layout()->disableLayout();
        if ($this->getRequest()->isPost()
            && $form->isValid($this->getRequest()->getPost())
        ) {
            $adapter = new Zend_Auth_Adapter_DbTable(
                Zend_Db_Table_Abstract::getDefaultAdapter(),
                'users',
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
    }

    public function logoutAction()
    {
        // odhlási z aplikácie
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('/auth/login');
    }


}





