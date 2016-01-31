<?php

class AtualizarController extends Zend_Controller_Action {

    protected $_redirector = null;

    public function init() {
        $this->_redirector = $this->_helper->getHelper('Redirector');
    }

    public function indexAction() {
        $id = $this->_request->getParam('id');

        if (isset($id)) {
            $auth = Zend_Auth::getInstance();
            $result = $auth->getStorage()->read();

            $dao = new Application_Model_UserDAO();
            $user = $dao->find($id);

            if ($result->id == $id) {
                $this->view->user = $user;
            } else if ($result->role == 'admin') {
                $this->view->user = $user;
            } else {
                return $this->_redirector->gotoUrl('/listar');
            }
        }
    }

    public function atualizarAction() {
        if ($this->getRequest()->isPost()) {
            $id = $this->_request->getParam('id');
            $nome = $this->_request->getParam('nome');
            $email = $this->_request->getParam('email');
            $role = $this->_request->getParam('role');

            if (!isset($role))
                $role = 'usuario';
            
            $user = new Application_Model_UserModelo();
            $user->setId($id);
            $user->setNome($nome);
            $user->setEmail($email);
            $user->setRole($role);
            
            $dao = new Application_Model_UserDAO();
            if($dao->atualiza($user))
                return $this->_redirector->gotoUrl('/listar');
            
            else return $this->_redirector->gotoUrl('/listar');
        }
        
    }
}
