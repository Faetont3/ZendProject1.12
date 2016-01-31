<?php

class RemoverController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        $this->view->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        $id = $this->_request->getParam('id');

        $dao = new Application_Model_UserDAO();
        
        if ($dao->remove($id))
            $mensagem = 'Removido com sucesso!';
        else
            $mensagem = 'Não foi removido!';

        $result = array(
            'mensagem' => $mensagem,
        );

        $this->_response->setBody(json_encode($result));
    }
}
