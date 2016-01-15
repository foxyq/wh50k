<?php

class Application_Form_MaterialDruh extends Zend_Form
{

    public function init()
    {
        $this->setName('materialDruh');

        $id = new Zend_Form_Element_Hidden('materialy_druhy_id');
        $id->addFilter('Int');

        $nazov = new Zend_Form_Element_Text('nazov');
        $nazov->setLabel('Názov')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->addValidator(new Zend_Validate_StringLength(array(
                     'max' => Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('materialy_druhy_nazov'))));


        $skratka = new Zend_Form_Element_Text('skratka');
        $skratka->setLabel('Skratka')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->addValidator(new Zend_Validate_StringLength(array(
                     'max' => Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('materialy_druhy_skratka'))));




        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $nazov, $skratka, $submit));
    }



}

