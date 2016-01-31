<?php

class Model_LibraryAcl extends Zend_Acl {
    public function __construct() {        
        $this->addResource( new Zend_Acl_Resource('index'));
        $this->addResource( new Zend_Acl_Resource('ativar'));
        $this->addResource( new Zend_Acl_Resource('cadastrar'));
        $this->addResource( new Zend_Acl_Resource('logar'));
        $this->addResource( new Zend_Acl_Resource('listar'));
        $this->addResource( new Zend_Acl_Resource('remover'));
        $this->addResource( new Zend_Acl_Resource('atualizar'));
        
        
        $this->addRole( new Zend_Acl_Role('usuario'));
        $this->addRole( new Zend_Acl_Role('admin'), 'usuario');
        
        $this->allow( null, 'index');
        $this->allow( null, 'logar');
        $this->allow( null, 'cadastrar');
        $this->allow( null, 'ativar');
        $this->allow( 'usuario', 'listar');
        $this->allow( 'usuario', 'atualizar');
        $this->allow( 'admin', 'remover');        
    }    
}
