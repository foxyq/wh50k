<?php

class Application_Form_Stroj extends Zend_Form
{

    public function init()
    {
        $this->setName('stroj');

        $id = new Zend_Form_Element_Hidden('stroje_id');
        $id->addFilter('Int');

        $nazov = new Zend_Form_Element_Text('nazov_stroja');
        $nazov->setLabel('Názov')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $typ_stroja = new Zend_Form_Element_Select('typ_stroja');
        $typ_stroja->setMultiOptions($this->getAttrib('strojeTypyMoznosti'));
        $typ_stroja->setLabel('Typ')
            ->setAttrib('class', 'form-control');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $nazov, $typ_stroja, $submit));
    }


}

