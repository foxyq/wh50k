<?php

class Application_Form_Vydaj extends Zend_Form
{

    public function init()
    {
        $this->setName('vydaj');


        $id = new Zend_Form_Element_Hidden('ts_vydaje_id');
        $id->addFilter('Int');

        $datum_vydaju_d = new Zend_Dojo_Form_Element_TimeTextBox('datum_vydaju_d');
        $datum_vydaju_d->setLabel('Dátum výdaju')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $sklad_enum = new Zend_Form_Element_Select('sklad_enum');
        $sklad_enum->setLabel("Sklad") //text pri boxe
            ->setName('sklad_enum');  // name pre html element do postu po odoslani formu

        $sklad_enum->addMultiOption('ZV','Sklad1'); //prve je value, druhe je vypis
        $sklad_enum->addMultiOption('BA','Sklad2');
        $sklad_enum->addMultiOption('KE','Sklad3');
        $sklad_enum->setValue('sklad2');
       // $this->addElement($sklad_enum);


         $podsklad_enum = new Zend_Dojo_Form_Element_NumberSpinner('$podsklad_enum');
        $podsklad_enum->addFilter('Int');
        $podsklad_enum->setLabel("Podsklad");


         $zakaznik_enum = new Zend_Dojo_Form_Element_NumberSpinner('$zakaznik_enum');
        $zakaznik_enum->addFilter('Int');
        $zakaznik_enum->setLabel("Zákazník");


         $prepravca_enum = new Zend_Dojo_Form_Element_NumberSpinner('$prepravca_enum');
        $prepravca_enum->addFilter('Int');
        $prepravca_enum->setLabel("Prepravca");

        $prepravca_spz = new Zend_Dojo_Form_Element_NumberSpinner('$prepravca_spz');
        $prepravca_spz->addFilter('Int');

        $stroj_enum = new Zend_Dojo_Form_Element_NumberSpinner('$stroj_enum');
        $stroj_enum->addFilter('Int');

        $q_tony_merane_brutto = new Zend_Dojo_Form_Element_NumberSpinner('$q_tony_merane_brutto ');
        $q_tony_merane_brutto ->addFilter('Int');

        $q_tony_merane_tara = new Zend_Dojo_Form_Element_NumberSpinner('q_tony_merane_tara');
        $q_tony_merane_tara->addFilter('Int');

        $q_tony_vypocet= new Zend_Dojo_Form_Element_NumberSpinner('$q_tony_vypocet ');
        $q_tony_vypocet ->addFilter('Int');

        $q_m3_merane = new Zend_Dojo_Form_Element_NumberSpinner('$q_m3_merane ');
        $q_m3_merane ->addFilter('Int');

        $q_m3_vypocet = new Zend_Dojo_Form_Element_NumberSpinner('$q_m3_vypocet');
        $q_m3_vypocet->addFilter('Int');

        $q_prm_merane = new Zend_Dojo_Form_Element_NumberSpinner('$q_prm_merane');
        $q_prm_merane->addFilter('Int');

        $q_prm_vypocet = new Zend_Dojo_Form_Element_NumberSpinner('$q_prm_vypocet');
        $q_prm_vypocet->addFilter('Int');

        $doklad_cislo = new Zend_Dojo_Form_Element_NumberSpinner('$doklad_cislo');
        $doklad_cislo->addFilter('Int');

        $doklad_typ_enum = new Zend_Dojo_Form_Element_NumberSpinner('$doklad_typ_enum');
        $doklad_typ_enum->addFilter('Int');

        $material_druh_enum = new Zend_Dojo_Form_Element_NumberSpinner('$material_druh_enum');
        $material_druh_enum->addFilter('Int');

        $poznamka = new Zend_Dojo_Form_Element_NumberSpinner('$poznamka');
        $poznamka->addFilter('Int');

        $chyba = new Zend_Dojo_Form_Element_NumberSpinner('$chyba');
        $chyba->addFilter('Int');

        $stav_transakcie = new Zend_Dojo_Form_Element_NumberSpinner('$stav_transakcie');
        $stav_transakcie->addFilter('Int');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('ts_vydaje_id', 'submitbutton');
//

          $data = array(

//            'vznik_zaznamu_dtm' => $array,
//            'vytvoril_u' => $array,
//            'posledna_uprava_dtm' => $array,
//            'posledna_uprava_u' => $array,
                'datum_vydaju_d' => $datum_vydaju_d,
            'sklad_enum' => $sklad_enum,
            'podsklad_enum' => $podsklad_enum,
            'zakaznik_enum' => $zakaznik_enum,
            'prepravca_enum' => $dopravca_enum,
            'prepravca_spz' => $prepravca_spz,
            'stroj_enum' => $stroj_enum,
            'q_tony_merane_brutto' => $q_tony_merane_brutto,
            'q_tony_merane_tara' => $q_tony_merane_tara,
            'q_tony_merane' => $q_tony_merane,
            'q_tony_vypocet' => $q_tony_vypocet,
            'q_m3_merane' => $q_m3_merane,
            'q_m3_vypocet' => $q_m3_vypocet,
            'q_prm_merane' => $q_prm_merane,
            'q_prm_vypocet' => $q_prm_vypocet,
            'doklad_cislo' => $doklad_cislo,
            'doklad_typ_enum' => $doklad_typ_enum,
            'material_druh_enum' => $material_druh_enum,
            'poznamka' => $poznamka,
            'chyba' => $chyba,
            'stav_transakcie' => $stav_transakcie,
            'submit' => $submit );

//        $this->addElements(array($id, $sklad_enum, $submit));
        $this->addElements($data);

    }


}

