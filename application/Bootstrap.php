<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initViewHelpers()
    {

        $view = new Zend_View();

//        $view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
//        $view->jQuery()->addStylesheet('/js/jquery/css/ui-lightness/jquery-ui-1.7.2.custom.css')
//            ->setLocalPath('/js/jquery/js/jquery-1.3.2.min.js')
//            ->setUiLocalPath('/js/jquery/js/jquery-ui-1.7.2.custom.min.js');
//
//        $view->jQuery()->enable();
////        $view->jQuery()->uiEnable();
//
//        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
//        $viewRenderer->setView($view);
//        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);


        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();

        $view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
        $viewRenderer->setView($view);
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);

        return $view;
    }
}

