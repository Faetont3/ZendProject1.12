<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        
        $form = new Application_Form_LoginForm();
        $form->setElementDecorators(array('ViewHelper', 'Errors')); // Retira DT
        $form->setDecorators(array('FormElements', 'Form')); // Retira DL
        $this->view->form = $form;
    }

}
