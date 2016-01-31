<?php

class AtivarController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        if ($this->getRequest()->isGet()) {
            $codigo_ativacao = $this->_request->getParam('ativacao');
            
            $mgm = "";
            
            $dao = new Application_Model_UserDAO();
            
            if($dao->verificaAtivacao($codigo_ativacao)){
                $mgm = 'Email ativado com sucesso! Clique em Home para logar.';
            }
            else $mgm = 'Email não foi ativado!';
        }        
        $this->view->mgm = $mgm;
    }
}
