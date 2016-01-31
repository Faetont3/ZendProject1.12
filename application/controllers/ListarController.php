<?php

class ListarController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {        
        $auth = Zend_Auth::getInstance();
        $result = $auth->getStorage()->read();
        
        $dao = new Application_Model_UserDAO();
        
        if($result->role != 'admin'){
            $find[] = $dao->find($result->id);
            $this->view->lista = $find;                    
        }else{            
            $this->view->lista = $dao->fetchAll();
        }
    }
}
