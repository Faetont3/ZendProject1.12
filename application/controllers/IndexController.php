<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        $auth = Zend_Auth::getInstance();
        $result = $auth->getStorage()->read();
        
        if($auth->hasIdentity())
            $ok = true;
        
        $mgm = $this->_request->getParam('mgm');
        
        if(isset($mgm))
            $this->view->mgm = $mgm;
        
        $this->view->ok = $ok;
        $this->view->result = $result;
    }
}
