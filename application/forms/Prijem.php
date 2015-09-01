<?php

class Application_Form_Prijem extends Zend_Form
{


    public function init()
    {
        $this->setName('prijem');

        $id = new Zend_Form_Element_Hidden('ts_prijmy_id');
        $id->addFilter('Int');

        //definicia filtrov
        $filterCislaDesatinaCiarka = new Zend_Filter_PregReplace(array('match' => '/,/', 'replace' => '.'));
        $filterTagy = new Zend_Filter_StripTags();
        $strToUpper = new Zend_Filter_StringToUpper();
        $filterOdstranCiarku = new Zend_Filter_PregReplace(array('match'=>'/-/', 'replace'=>''));
        $filterOdstranMedzery = new Zend_Filter_PregReplace(array('match'=>'/ /', 'replace'=>''));

        //definicia validatorov
        $validatorDatum = new Zend_Validate_Date();
        $validatorDatum->setMessage('Dátum nevyhovuje formátu rrrr-mm-dd', Zend_Validate_Date::FALSEFORMAT);
        $validatorPercentaRange = new Zend_Validate_Between(array('min' => 0, 'max' => 99.99));
        $validatorPercentaRange->setMessage("Zadané číslo sa nenachádza v intervale od 0 do 99,99.");
        $validatorCislaRange = new Zend_Validate_Between(array('min' => 0, 'max' => 999.99));
        $validatorCislaRange->setMessage("Zadané číslo sa nenachádza v intervale od 0 do 999,99.");
        $validatorSPZ = new Zend_Validate_Regex(array('pattern'=> "/[1-Z]{2}[0-9]{3}[A-Z]{2}/"));
        $validatorSPZ->setMessage('Zadali ste ŠPZ v nesprávnom tvare', Zend_Validate_Regex::NOT_MATCH);




        $actionName = strtolower(Zend_Controller_Front::getInstance()->getRequest()->getActionName());
        $submitButtonClass = "success";
        if ($actionName == 'edit'){
            $submitButtonClass = "primary";
        }
//
        $datum_prijmu = new ZendX_JQuery_Form_Element_DatePicker("datum_prijmu_d",
            "12.12.2014", array(), array());

        $datum_prijmu->setValue(Zend_Date::now()->toString('YYYY-MM-dd'));

        $datum_prijmu->setJQueryParam('dateFormat', 'yy-mm-dd')
            ->setRequired(true)
            ->setLabel("Dátum príjmu")
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->addValidator($validatorDatum)
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
            ->setAttrib('class', 'form-control')
            ->addFilter($strToUpper)
            ->addFilter($filterOdstranCiarku)
            ->addFilter($filterOdstranMedzery)
            ->addValidator($validatorSPZ);

        /*
         * KVANTITA
         */

        $q_tony_merane = new Zend_Form_Element_Text('q_tony_merane');
        $q_tony_merane->setLabel('Tony netto')
            ->setAttrib('class', 'form-control in')
            ->setAttrib('tabindex', '-1')
            ->addFilter($filterCislaDesatinaCiarka)
            ->addValidator($validatorCislaRange);
            //->addValidator('float');


        $q_tony_brutto = new Zend_Form_Element_Text('q_tony_brutto');
        $q_tony_brutto->setLabel('Tony brutto')
            ->setAttrib('class', 'form-control in')
            ->setAttrib('tabindex', '-1')
            ->addFilter($filterCislaDesatinaCiarka)
            ->addValidator($validatorCislaRange);
            //->addValidator('float');

        $q_tony_tara = new Zend_Form_Element_Text('q_tony_tara');
        $q_tony_tara->setLabel('Tony tara')
            ->setAttrib('class', 'form-control in')
            ->setAttrib('tabindex', '-1')
            ->addFilter($filterCislaDesatinaCiarka)
            ->addValidator($validatorCislaRange);
            //->addValidator('float');


        $q_tony_nadrozmer = new Zend_Form_Element_Text('q_tony_nadrozmer');
        $q_tony_nadrozmer->setLabel('Tony nadrozmer')
            ->setAttrib('class', 'form-control in')
            ->setAttrib('tabindex', '-1')
            ->addFilter($filterCislaDesatinaCiarka)
            ->addValidator($validatorCislaRange);
            //->addValidator('float');

        $q_m3_merane = new Zend_Form_Element_Text('q_m3_merane');
        $q_m3_merane->setLabel('Merané m3' )
            ->setAttrib('class', 'form-control in')
            ->setAttrib('tabindex', '-1')
            ->addFilter($filterCislaDesatinaCiarka)
            ->addValidator($validatorCislaRange);
            //->addValidator('float');

        $q_prm_merane = new Zend_Form_Element_Text('q_prm_merane');
        $q_prm_merane->setLabel('Merané PRM')
            ->setAttrib('class', 'form-control in')
            ->setAttrib('tabindex', '-1')
            ->addFilter($filterCislaDesatinaCiarka)
            ->addValidator($validatorCislaRange);
            //->addValidator('float');

        $q_vlhkost = new Zend_Form_Element_Text('q_vlhkost');
        $q_vlhkost->setLabel('Vlhkosť')
            ->setAttrib('class', 'form-control in')
            ->setAttrib('tabindex', '-1')
            ->addFilter($filterCislaDesatinaCiarka)
            ->addValidator($validatorPercentaRange);
            //->addValidator('Float');

        /*
         * DOPLNUJUCE INFO
         */

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
            ->setAttrib('class', 'form-control')
            ->setAttrib('onchange', 'getComboA(this)');

        $poznamka = new Zend_Form_Element_Text('poznamka');
        $poznamka->setLabel('Poznámka')
            ->setAttrib('class', 'form-control')
            ->addFilter($filterTagy);

        $chyba = new Zend_Form_Element_Checkbox('chyba');
        $chyba->setLabel('Chyba');

        $stav_transakcie = new Zend_Form_Element_Select('stav_transakcie');
        $stav_transakcie->setMultiOptions($this->getAttrib('transakcieStavyMoznosti'));
        $stav_transakcie->setLabel('Stav transakcie')
            ->setAttrib('class', 'form-control');

        $potvrdzujuceTlacidlo = new Zend_Form_Element_Submit('potvrdzujuceTlacidlo');
        $potvrdzujuceTlacidlo->setLabel($this->getAttrib('potvrdzujuceTlacidlo'));
        $potvrdzujuceTlacidlo->setAttrib('id', 'submitbutton')
            ->setAttrib('class', 'form-control btn-'.$submitButtonClass);


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
            $q_vlhkost,
//            $doklad_typ,
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

