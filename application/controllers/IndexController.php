<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {        
        $mgm = $this->_request->getParam('mgm');
        
        if(isset($mgm))
            $this->view->mgm = $mgm;            
    }
}
