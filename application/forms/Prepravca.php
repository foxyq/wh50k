<?php

class Application_Form_Prepravca extends Zend_Form
{

    public function init()
    {


        $this->setName('prepravca');

        $id = new Zend_Form_Element_Hidden('prepravci_id');
        $id->addFilter('Int');

        $kod = new Zend_Form_Element_Text('kod');
        $kod->setLabel('Kod')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $meno = new Zend_Form_Element_Text('meno');
        $meno->setLabel('Meno')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $kod, $meno, $submit));
    }



}

