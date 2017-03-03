<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
    
    protected function _initDoctype() {
        defined('ERROR_OK') OR define('ERROR_OK', 0); 
        defined('ERROR_FAIL') OR define('ERROR_FAIL', 1); 
        Zend_Layout::startMvc();
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }
}

