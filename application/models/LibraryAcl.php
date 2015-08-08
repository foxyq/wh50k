<?php

class Application_Model_LibraryAcl extends Zend_Acl
{
    public function __construct(){
        //index sa evidentne nasekava automaticky,...damn nigga - what the hell?


        /*
         * resources - definition
         */
        //definicia login resource
        $this->add(new Zend_Acl_Resource('default:auth'));

        //definicia default resources
        //$this->add(new Zend_Acl_Resource('default:vydaje'));
        $this->add(new Zend_Acl_Resource('default:index'));
        $this->add(new Zend_Acl_Resource('default:error'));
        $this->add(new Zend_Acl_Resource('default:prijmy'));


        //definicia skladnik resources
        $this->add(new Zend_Acl_Resource('skladnik:index'));

        /*
         * roles - definition
         */
        $this->addRole('1');//superdmin
        $this->addRole('2');//admin
        $this->addRole('3');//skladnik

        //assignment of resources to roles

        //superadmin
        $this->allow('1', 'default:index');
        $this->allow('1', 'default:prijmy');

        //admin
        $this->allow('2', 'default:index');

        //skladnik
        $this->allow('3', 'skladnik:index');

        //priradenie vsetkym prava na auth - ogin aj logout
        $this->allow(null, 'default:auth');


    }


}

