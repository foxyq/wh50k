<?php

class Application_Form_Prijem extends Zend_Form
{


    public function init()
    {
        $this->setName('prijem');

        $id = new Zend_Form_Element_Hidden('ts_prijmy_id');
        $id->addFilter('Int');

//        povodny textfield datum, fo sho
//        $datum_prijmu = new Zend_Form_Element_Text('datum_prijmu_d');
//        $datum_prijmu->setLabel('Dátum príjmu');
//
        $datum_prijmu = new ZendX_JQuery_Form_Element_DatePicker("datum_prijmu_d",
            "12.12.2014", array(), array());

        $datum_prijmu->setValue(Zend_Date::now()->toString('YYYY-MM-dd'));

        $datum_prijmu->setJQueryParam('dateFormat', 'yy-mm-dd')
//            ->setJqueryParam('regional', 'de')
            ->setRequired(true)
            ->setLabel("Dátum príjmu")
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');


        $sklad = new Zend_Form_Element_Select('sklad_enum');
        $sklad->setMultiOptions($this->getAttrib('skladyMoznosti'));
        $sklad->setLabel('Sklad');

        $podsklad = new Zend_Form_Element_Select('podsklad_enum');
        $podsklad->setMultiOptions($this->getAttrib('podskladyMoznosti'));
        $podsklad->setLabel('Podsklad');

        $dodavatel = new Zend_Form_Element_Select('dodavatel_enum');
        $dodavatel->setMultiOptions($this->getAttrib('dodavateliaMoznosti'));
        $dodavatel->setLabel('Dodávateľ');

        $prepravca = new Zend_Form_Element_Select('prepravca_enum');
        $prepravca->setMultiOptions($this->getAttrib('prepravciMoznosti'));
        $prepravca->setLabel('Prepravca');

        $prepravca_spz = new Zend_Form_Element_Text('prepravca_spz');
        $prepravca_spz->setLabel('ŠPZ');
        $prepravca_spz->setRequired(true);
        //$prepravca_spz->addValidator('regex', false, array('^(B(A|B|C|J|L|N|R|S|Y)|CA|D(K|S|T)|G(A|L)|H(C|E)|IL|K(A|I|E|K|M|N|S)|L(E|C|M|V)|M(A|I|L|T|Y)|N(I|O|M|R|Z)|P(B|D|E|O|K|N|P|T|U|V)|R(A|K|S|V)|S(A|B|C|E|I|K|L|O|N|P|V)|T(A|C|N|O|R|S|T|V)|V(K|T)|Z(A|C|H|I|M|V))([ ]{0,1})([0-9]{3})([A-Z]{2})$'));



        $q_tony_merane = new Zend_Form_Element_Text('q_tony_merane');
        $q_tony_merane->setLabel('Tony merané');

        $q_tony_nadrozmer = new Zend_Form_Element_Text('q_tony_nadrozmer');
        $q_tony_nadrozmer->setLabel('Tony nadrozmer');


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
            $datum_prijmu,
            $sklad,
            $podsklad,
            $dodavatel,
            $prepravca,
            $prepravca_spz,
            $q_tony_merane,
            $q_tony_nadrozmer,
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

