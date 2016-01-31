<?php

class LogarController extends Zend_Controller_Action {

    protected $_redirector = null;

    public function init() {
        $this->_redirector = $this->_helper->getHelper('Redirector');
    }

    public function indexAction() {
        if ($this->getRequest()->isPost()) {

            $email = $this->_request->getParam('email');
            $senha = md5($this->_request->getParam('senha'));

            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
            $authAdapter->setTableName('user')
                        ->setIdentityColumn('email')
                        ->setCredentialColumn('senha');

            $authAdapter->setIdentity($email)->setCredential($senha);
            $auth = Zend_Auth::getInstance();
            $result = $auth->authenticate($authAdapter);

            if ($result->isValid()) {
                $user = $authAdapter->getResultRowObject();
                if (!$user->status == 1) {
                    return $this->_forward('logout');
                } else {
                    $auth->getStorage()->write($user);
                    $this->_redirect('listar');
                }
            } else {
                $this->_redirect('index');
            }
        }
    }

    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $this->redirect('index');
    }
}
