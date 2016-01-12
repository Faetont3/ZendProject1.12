<?php

class RemoverController extends Zend_Controller_Action
{
    protected $_redirector = null;

    public function init()
    {
        $this->_redirector = $this->_helper->getHelper('Redirector');
    }

    public function indexAction()
    {
        $dado = $this->_request->getParam('dado');
        $remover = new Application_Model_UserDAO();
        if($remover->remove($dado))
            return $this->_redirector->gotoUrl('/listar/index');
        return $this->_redirector->gotoUrl('/listar/index');
    }


}

