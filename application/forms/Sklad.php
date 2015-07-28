<?php

class Application_Form_Sklad extends Zend_Form
{

    public function init()
    {

        $this->setName('sklad');

        $id = new Zend_Form_Element_Hidden('sklady_id');
        $id->addFilter('Int');

        $kod_skladu = new Zend_Form_Element_Text('kod_skladu');
        $kod_skladu->setLabel('Kód')
            //->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $nazov_skladu = new Zend_Form_Element_Text('nazov_skladu');
        $nazov_skladu->setLabel('Názov')
            //->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');


        $skratka_skladu = new Zend_Form_Element_Text('skratka_skladu');
        $skratka_skladu->setLabel('Skratka')
            //->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');



        $mesto_enum = new Zend_Form_Element_Select('mesto_enum');
        $mesto_enum->setMultiOptions($this->getAttrib('mestaMoznosti'));
        $mesto_enum->setLabel('Mesto')
            ->setAttrib('class', 'form-control');

        $merna_jednotka = new Zend_Form_Element_Select('merna_jednotka_enum');
        $merna_jednotka->setMultiOptions($this->getAttrib('merneJednotkyMoznosti'));
        $merna_jednotka->setLabel('Merná jednotka')
            ->setAttrib('class', 'form-control');



        $adresa = new Zend_Form_Element_Text('adresa');
        $adresa->setLabel('Adresa')
            //->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');



        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $kod_skladu, $nazov_skladu, $skratka_skladu, $mesto_enum, $merna_jednotka, $adresa, $submit));
    }



}

