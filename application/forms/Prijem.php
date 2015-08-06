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
            ->addValidator('NotEmpty')
            ->setAttrib('class', 'form-control');


        $sklad = new Zend_Form_Element_Select('sklad_enum');
        $sklad->setMultiOptions($this->getAttrib('skladyMoznosti'));
        $sklad->setLabel('Sklad')
            ->setAttrib('class', 'form-control');

        $podsklad = new Zend_Form_Element_Select('podsklad_enum');
        $podsklad->setMultiOptions($this->getAttrib('podskladyMoznosti'));
        $podsklad->setLabel('Podsklad')
            ->setAttrib('class', 'form-control');

        $dodavatel = new Zend_Form_Element_Select('dodavatel_enum');
        $dodavatel->setMultiOptions($this->getAttrib('dodavateliaMoznosti'));
        $dodavatel->setLabel('Dodávateľ')
            ->setAttrib('class', 'form-control');

        $prepravca = new Zend_Form_Element_Select('prepravca_enum');
        $prepravca->setMultiOptions($this->getAttrib('prepravciMoznosti'));
        $prepravca->setLabel('Prepravca')
            ->setAttrib('class', 'form-control');

        $prepravca_spz = new Zend_Form_Element_Text('prepravca_spz');
        $prepravca_spz->setLabel('ŠPZ');
        $prepravca_spz->setRequired(true)
            ->setAttrib('class', 'form-control');
        //$prepravca_spz->addValidator('regex', false, array('^(B(A|B|C|J|L|N|R|S|Y)|CA|D(K|S|T)|G(A|L)|H(C|E)|IL|K(A|I|E|K|M|N|S)|L(E|C|M|V)|M(A|I|L|T|Y)|N(I|O|M|R|Z)|P(B|D|E|O|K|N|P|T|U|V)|R(A|K|S|V)|S(A|B|C|E|I|K|L|O|N|P|V)|T(A|C|N|O|R|S|T|V)|V(K|T)|Z(A|C|H|I|M|V))([ ]{0,1})([0-9]{3})([A-Z]{2})$'));



        $q_tony_merane = new Zend_Form_Element_Text('q_tony_merane');
        $q_tony_merane->setLabel('Tony merané')
            ->setAttrib('class', 'form-control');

        $q_tony_brutto = new Zend_Form_Element_Text('q_tony_brutto');
        $q_tony_brutto->setLabel('Tony brutto')
            ->setAttrib('class', 'form-control');

        $q_tony_tara = new Zend_Form_Element_Text('q_tony_tara');
        $q_tony_tara->setLabel('Tony tara')
            ->setAttrib('class', 'form-control');

        $q_tony_nadrozmer = new Zend_Form_Element_Text('q_tony_nadrozmer');
        $q_tony_nadrozmer->setLabel('Tony nadrozmer')
            ->setAttrib('class', 'form-control');




        $q_m3_merane = new Zend_Form_Element_Text('q_m3_merane');
        $q_m3_merane->setLabel('Merané m3' )
            ->setAttrib('class', 'form-control');

        $q_prm_merane = new Zend_Form_Element_Text('q_prm_merane');
        $q_prm_merane->setLabel('Merané PRM')
            ->setAttrib('class', 'form-control');



        //TODO
        //$doklad_cislo;

        $doklad_typ = new Zend_Form_Element_Select('doklad_typ_enum');
        $doklad_typ->setMultiOptions($this->getAttrib('dokladyTypyMoznosti'));
        $doklad_typ->setLabel('Doklad typ')
            ->setAttrib('class', 'form-control');

        $material_typ = new Zend_Form_Element_Select('material_typ_enum');
        $material_typ->setMultiOptions($this->getAttrib('materialyTypyMoznosti'));
        $material_typ->setLabel('Materiál typ')
            ->setAttrib('class', 'form-control');


        $material_druh = new Zend_Form_Element_Select('material_druh_enum');
        $material_druh->setMultiOptions($this->getAttrib('materialyDruhyMoznosti'));
        $material_druh->setLabel('Materiál druh')
            ->setAttrib('class', 'form-control');

        $poznamka = new Zend_Form_Element_Text('poznamka');
        $poznamka->setLabel('Poznámka')
            ->setAttrib('class', 'form-control');

        $chyba = new Zend_Form_Element_Checkbox('chyba');
        $chyba->setLabel('Chyba');

        $stav_transakcie = new Zend_Form_Element_Select('stav_transakcie');
        $stav_transakcie->setMultiOptions($this->getAttrib('transakcieStavyMoznosti'));
        $stav_transakcie->setLabel('Stav transakcie')
            ->setAttrib('class', 'form-control');

        $potvrdzujuceTlacidlo = new Zend_Form_Element_Submit('potvrdzujuceTlacidlo');
        $potvrdzujuceTlacidlo->setLabel($this->getAttrib('potvrdzujuceTlacidlo'));
        $potvrdzujuceTlacidlo->setAttrib('id', 'submitbutton')
            ->setAttrib('class', 'form-control btn-success ');


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
            $q_tony_brutto,
            $q_tony_tara,
            $q_m3_merane,
            $q_prm_merane,
            $doklad_typ,
            $material_druh,
            $material_typ,
            $poznamka,
            $chyba,
            $stav_transakcie,
            $potvrdzujuceTlacidlo
        ));

//        var_dump($_SESSION);
    }


}

