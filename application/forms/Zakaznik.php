<?php

class Application_Form_Zakaznik extends Zend_Form
{

    public function init()
    {

        $this->setName('zakaznik');


        $actionName = strtolower(Zend_Controller_Front::getInstance()->getRequest()->getActionName());
        $submitButtonClass = "success";
        if ($actionName == 'edit'){
            $submitButtonClass = "primary";
        }

        $id = new Zend_Form_Element_Hidden('zakaznici_id');
        $id->addFilter('Int');

        $meno = new Zend_Form_Element_Text('meno');
        $meno->setLabel('Meno')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->addValidator(new Zend_Validate_StringLength(array(
                     'max' => Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('zakaznici_meno'))))
            ->setAttrib('class', 'form-control');;;


        $nazov_spolocnosti = new Zend_Form_Element_Text('nazov_spolocnosti');
        $nazov_spolocnosti->setLabel('Názov spoločnosti')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->addValidator(new Zend_Validate_StringLength(array(
                     'max' => Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('zakaznici_nazov_spolocnosti'))))
            ->setAttrib('class', 'form-control');;;


        $merna_jednotka = new Zend_Form_Element_Select('merna_jednotka_enum');
        $merna_jednotka->setMultiOptions($this->getAttrib('merneJednotkyMoznosti'));
        $merna_jednotka->setLabel('Merná jednotka')
            ->setAttrib('class', 'form-control');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton')
                ->setAttrib('class', 'form-control btn-'.$submitButtonClass);

        $this->addElements(array($id, $meno, $nazov_spolocnosti, $merna_jednotka, $submit));
    }


}

