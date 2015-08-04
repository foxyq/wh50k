<?php

class Application_Form_Podsklad extends Zend_Form
{

    public function init()
    {
        $this->setName('podsklad');

        $id = new Zend_Form_Element_Hidden('podsklady_id');
        $id->addFilter('Int');

        $nazov = new Zend_Form_Element_Text('nazov_podskladu');
        $nazov->setLabel('Názov')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $kod = new Zend_Form_Element_Text('kod_podskladu');
        $kod->setLabel('Kód')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $mesto = new Zend_Form_Element_Select('mesto_enum');
        $mesto->setMultiOptions($this->getAttrib('mestaMoznosti'));
        $mesto->setLabel('Mesto')
            ->setAttrib('class', 'form-control');

        $adresa = new Zend_Form_Element_Text('adresa');
        $adresa->setLabel('Adresa')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $nazov, $kod, $mesto, $adresa, $submit));
    }


}
