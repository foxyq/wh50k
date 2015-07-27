<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        $this->setName("login");
        $this->setMethod(self::METHOD_POST);
        $this->addElement(new Zend_Form_Element_Text(array(
            'name' => 'email',
            'label' => 'E-mail',
            'required' => true,
        )));
        $this->addElement(new Zend_Form_Element_Password(array(
            'name' => 'password',
            'label' => 'Heslo',
            'required' => true,
        )));
        $this->addElement(new Zend_Form_Element_Submit(array(
            'name' => 'submitButton',
            'label' => 'Prihlásiť sa',
            'ignore' => true,
        )));
    }



}

