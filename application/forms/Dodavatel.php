<?php

class Application_Form_Dodavatel extends Zend_Form
{

    public function init()
    {
        $this->setName('dodavatel');

        $id = new Zend_Form_Element_Hidden('dodavatelia_id');
        $id->addFilter('Int');

        $meno = new Zend_Form_Element_Text('meno');
        $meno->setLabel('Meno');
        $meno->setRequired(true);

        $nazov_spolocnosti = new Zend_Form_Element_Text('nazov_spolocnosti');
        $nazov_spolocnosti->setLabel('Názov spoločnosti');
        $nazov_spolocnosti->setRequired(true);

        $ico = new Zend_Form_Element_Text('ico');
        $ico->setLabel('IČO');
        $ico->setRequired(true);

        $potvrdzujuceTlacidlo = new Zend_Form_Element_Submit('potvrdzujuceTlacidlo');
        $potvrdzujuceTlacidlo->setLabel($this->getAttrib('potvrdzujuceTlacidlo'));
        $potvrdzujuceTlacidlo->setAttrib('id', 'submitbutton');

        $this->addElements(array(
            $id,
            $meno,
            $nazov_spolocnosti,
            $ico,
            $potvrdzujuceTlacidlo
        ));

    }


}

