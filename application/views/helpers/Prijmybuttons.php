<?php
class Zend_View_Helper_prijmybuttons extends Zend_View_Helper_Abstract
{
    public function prijmybuttons($a,$prijmy_w, $prijmy_e)
    {

        echo '<p class="no-print">
                <a href="'. $a->url(array('controller'=>'Prijmy', 'action'=>'add', 'fromAction' => 'list')).'" type="button" class="btn btn-success">Pridať príjem</a> ';

        echo ' <a href="' .$a->url(array('controller'=>'Prijmy', 'action'=>'list')).'" type="button" class="btn btn-info">Všetky príjmy</a> ' ;


    if ($prijmy_w >0) {

        echo ' <a href="' . $a->url(array('controller' => 'prijmy', 'action' => 'waitings'), null, true) . '" type="button" class="btn btn-warning">Na schválenie (' . $prijmy_w . ')</a> ';
    }

    if ($prijmy_e > 0) {

        echo ' <a href="' . $a->url(array('controller' => 'prijmy', 'action' => 'errors'), null, true) . '" type="button" class="btn btn-danger"> Chybné (' . $prijmy_e . ')</a> ';
    }

    echo ' <a class="btn btn-primary" href="javascript:window.print()">Tlačiť</a> </p>';

    }
}
?>