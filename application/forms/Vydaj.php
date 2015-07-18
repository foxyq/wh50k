<?php

class Application_Form_Vydaj extends ZendX_JQuery_Form

{

    public function init()
    {
        $this->setName('vydaj');

        $id = new Zend_Form_Element_Hidden('ts_vydaje_id');
        $id->addFilter('Int');

        //echo Zend_Date::now()->toString('yyyy-MM-dd');

        $datum_vydaju = new ZendX_JQuery_Form_Element_DatePicker("datum_vydaju_d",
                            "12.12.2014", array(), array());

        $datum_vydaju->setValue(Zend_Date::now()->toString('YYYY-MM-dd'));

        $datum_vydaju->setJQueryParam('dateFormat', 'yy-mm-dd')
//            ->setJqueryParam('regional', 'de')
            ->setRequired(true)
            ->setLabel("Dátum výdaju")
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

//        $datum_vydaju = new Zend_Dojo_Form_Element_TimeTextBox('datum_vydaju_d');
//        $datum_vydaju->setLabel('Dátum výdaju')
//            ->setRequired(true)
//            ->addFilter('StripTags')
//            ->addFilter('StringTrim')
//            ->addValidator('NotEmpty');

        $sklad = new Zend_Form_Element_Select('sklad_enum');
        $sklad->setMultiOptions($this->getAttrib('skladyMoznosti'));
        $sklad->setLabel('Sklad');

        $podsklad = new Zend_Form_Element_Select('podsklad_enum');
        $podsklad->setMultiOptions($this->getAttrib('podskladyMoznosti'));
        $podsklad->setLabel('Podsklad');


        $zakaznik = new Zend_Form_Element_Select('$zakaznik_enum');
        $zakaznik->setMultiOptions($this->getAttrib('zakazniciMoznosti'));
        $zakaznik->setLabel("Zákazník");


        $prepravca = new Zend_Form_Element_Select('prepravca_enum');
        $prepravca->setMultiOptions($this->getAttrib('prepravciMoznosti'));
        $prepravca->setLabel('Prepravca');

        $prepravca_spz = new Zend_Form_Element_Text('prepravca_spz');
        $prepravca_spz->setLabel('ŠPZ');
        $prepravca_spz->setRequired(true);
        //$prepravca_spz->addValidator('regex', false, array('^(B(A|B|C|J|L|N|R|S|Y)|CA|D(K|S|T)|G(A|L)|H(C|E)|IL|K(A|I|E|K|M|N|S)|L(E|C|M|V)|M(A|I|L|T|Y)|N(I|O|M|R|Z)|P(B|D|E|O|K|N|P|T|U|V)|R(A|K|S|V)|S(A|B|C|E|I|K|L|O|N|P|V)|T(A|C|N|O|R|S|T|V)|V(K|T)|Z(A|C|H|I|M|V))([ ]{0,1})([0-9]{3})([A-Z]{2})$'));


        $stroj_enum = new Zend_Dojo_Form_Element_NumberSpinner('$stroj_enum');
        $stroj_enum->addFilter('Int');
//
//        $q_tony_merane_brutto = new Zend_Dojo_Form_Element_NumberSpinner('$q_tony_merane_brutto ');
//        $q_tony_merane_brutto ->addFilter('Int');
//
//        $q_tony_merane_tara = new Zend_Dojo_Form_Element_NumberSpinner('q_tony_merane_tara');
//        $q_tony_merane_tara->addFilter('Int');
//
//        $q_tony_vypocet= new Zend_Dojo_Form_Element_NumberSpinner('$q_tony_vypocet ');
//        $q_tony_vypocet ->addFilter('Int');
//
//        $q_m3_merane = new Zend_Dojo_Form_Element_NumberSpinner('$q_m3_merane ');
//        $q_m3_merane ->addFilter('Int');
//
//        $q_m3_vypocet = new Zend_Dojo_Form_Element_NumberSpinner('$q_m3_vypocet');
//        $q_m3_vypocet->addFilter('Int');
//
//        $q_prm_merane = new Zend_Dojo_Form_Element_NumberSpinner('$q_prm_merane');
//        $q_prm_merane->addFilter('Int');
//
//        $q_prm_vypocet = new Zend_Dojo_Form_Element_NumberSpinner('$q_prm_vypocet');
//        $q_prm_vypocet->addFilter('Int');

        $q_tony_merane = new Zend_Form_Element_Text('q_tony_merane');
        $q_tony_merane->setLabel('Tony merané');



        //TODO
        //$doklad_cislo;

        $doklad_typ = new Zend_Form_Element_Select('doklad_typ_enum');
        $doklad_typ->setMultiOptions($this->getAttrib('dokladyTypyMoznosti'));
        $doklad_typ->setLabel('Doklad typ');

        $material_typ = new Zend_Form_Element_Select('material_typ_enum');
        $material_typ->setMultiOptions($this->getAttrib('materialyTypyMoznosti'));
        $material_typ->setLabel('Materiál typ');


        $material_druh = new Zend_Form_Element_Select('material_druh_enum');
        $material_druh->setMultiOptions($this->getAttrib('materialyDruhyMoznosti'));
        $material_druh->setLabel('Materiál druh');

        $poznamka = new Zend_Form_Element_Text('poznamka');
        $poznamka->setLabel('Poznámka');

        $chyba = new Zend_Form_Element_Checkbox('chyba');
        $chyba->setLabel('Chyba');

        $stav_transakcie = new Zend_Form_Element_Select('stav_transakcie');
        $stav_transakcie->setMultiOptions($this->getAttrib('transakcieStavyMoznosti'));
        $stav_transakcie->setLabel('Stav transakcie');

        $potvrdzujuceTlacidlo = new Zend_Form_Element_Submit('potvrdzujuceTlacidlo');
        $potvrdzujuceTlacidlo->setLabel($this->getAttrib('potvrdzujuceTlacidlo'));
        $potvrdzujuceTlacidlo->setAttrib('id', 'submitbutton');



        $this->addElements(array(
            $id,
            $datum_vydaju,
            $sklad,
            $podsklad,
            $zakaznik,
            $prepravca,
            $prepravca_spz,
            $q_tony_merane,
            $doklad_typ,
            $material_druh,
            $material_typ,
            $poznamka,
            $chyba,
            $stav_transakcie,
            $potvrdzujuceTlacidlo
        ));




    }


}

