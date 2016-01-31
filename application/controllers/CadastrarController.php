<?php

class CadastrarController extends Zend_Controller_Action {

    protected $_redirector = null;

    public function init() {
        $this->_redirector = $this->_helper->getHelper('Redirector');
    }

    public function indexAction() {        
        if ($this->getRequest()->isPost()) {
            
            $nome = $this->_request->getParam('nome');
            $email = $this->_request->getParam('email');
            $senha = md5($this->_request->getParam('senha'));

            $user = new Application_Model_UserModelo();
            $user->setNome($nome);
            $user->setEmail($email);
            $user->setSenha($senha);
            $user->setRole('usuario');
            $user->setStatus('0');
            $user->setAtivacao(md5(uniqid(rand())));
            
            $dao = new Application_Model_UserDAO();
            $mail = new Application_Model_Mail();
            
            $dao->save($user);
            
            $url = $this->view->serverUrl() . $this->view->baseUrl();
            $mgm = $mail->enviarEmail($url, $user->getEmail(), $user->getAtivacao());
            
            return $this->_redirector->gotoUrl('/index/index?mgm='. $mgm);
        }        
    }
}
