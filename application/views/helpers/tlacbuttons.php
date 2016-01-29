<?php
class Zend_View_Helper_tlacbuttons extends Zend_View_Helper_Abstract
{
    public function tlacbuttons($a,$merna_jednotka, $id)
    {

        if ($merna_jednotka == 1 ) {
            echo '<a href="' . $a->url(array("controller" => "Prijmy", "action" => "printton", "id" => $id, "fromAction" => "errors",
                )) . '" target="_blank"><i class="fa fa-print"></i></a>';
        }

        if ($merna_jednotka == 2 ) {
            echo '<a href="' . $a->url(array("controller" => "Prijmy", "action" => "printprm", "id" => $id, "fromAction" => "errors",
                )) . '" target="_blank"><i class="fa fa-print"></i></a>';
        }

        if ($merna_jednotka == 3 ) {
            echo '<a href="' . $a->url(array("controller" => "Prijmy", "action" => "printm3", "id" => $id, "fromAction" => "errors",
                )) . '" target="_blank"><i class="fa fa-print"></i></a>';
        }

    }
}
?>