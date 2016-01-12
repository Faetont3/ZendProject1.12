<?php

class ListarController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $listar = new Application_Model_UserDAO();
        $this->view->lista = $listar->fetchAll();
    }


}

