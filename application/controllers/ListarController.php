<?php

class ListarController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {        
        $auth = Zend_Auth::getInstance();
        $result = $auth->getStorage()->read();
        
        if($result->role == 'admin')
            $role = true;
        
        else $role = false;
        
        $dao = new Application_Model_UserDAO();
        
        if($result->role != 'admin'){
            $find[] = $dao->find($result->id);
            $this->view->lista = $find; 
            $this->view->role = $role;
        }else{            
            $this->view->lista = $dao->fetchAll();
            $this->view->role = $role;
        }
    }
}
