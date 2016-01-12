<?php

class Application_Form_LoginForm extends Zend_Form
{

    public function init()
    {
        Zend_Form::setAttrib('class','form-signin');
         $login = new Zend_Form_Element_Text('login');
        $login->setAttrib('class', 'form-control')               
                ->setAttrib('placeholder', 'Email address')
                ->setRequired(true)
                ->addFilter('StripTags')                
                ->addFilter('StringTrim');
                

        $senha = new Zend_Form_Element_Password('senha');
        $senha->setAttrib('class', 'form-control')
                ->setAttrib('placeholder', 'Password')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim');
        
        $submit = new Zend_Form_Element_Submit('Entrar');
        $submit->setAttrib('class', 'btn btn-lg btn-primary btn-block');
        $this->addElements(array($login, $senha, $submit));
        
    }


}

