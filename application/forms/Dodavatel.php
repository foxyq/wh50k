<?php

class Application_Form_Dodavatel extends Zend_Form
{

    public function init()
    {
        $this->setName('dodavatel');

        $id = new Zend_Form_Element_Hidden('dodavatelia_id');
        $id->addFilter('Int');

        $meno = new Zend_Form_Element_Text('meno');
        $meno->setLabel('Meno')
             ->setRequired(true)
             ->addValidator(new Zend_Validate_StringLength(array(
                 'max' => Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('dodavatelia_meno'))));

        $nazov_spolocnosti = new Zend_Form_Element_Text('nazov_spolocnosti');
        $nazov_spolocnosti->setLabel('Názov spoločnosti')
                          ->setRequired(true)
                          ->addValidator(new Zend_Validate_StringLength(array(
                              'max' => Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('dodavatelia_nazov'))));;

        $ico = new Zend_Form_Element_Text('ico');
        $ico->setLabel('IČO')
            ->setRequired(true)
            ->addValidator(new Zend_Validate_StringLength(array(
                 'max' => Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('dodavatelia_ico'))));

        $potvrdzujuceTlacidlo = new Zend_Form_Element_Submit('potvrdzujuceTlacidlo');
        $potvrdzujuceTlacidlo->setLabel($this->getAttrib('potvrdzujuceTlacidlo'));
        $potvrdzujuceTlacidlo->setAttrib('id', 'submitbutton');
//            ->setAttrib('class', 'form-control btn-success btn');

        $this->addElements(array(
            $id,
            $meno,
            $nazov_spolocnosti,
            $ico,
            $potvrdzujuceTlacidlo
        ));

    }


}

