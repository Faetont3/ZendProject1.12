<?php

class Application_Model_UserModelo {
    protected $_nome;
    protected $_email;
    protected $_senha;
    protected $_id;
    protected $_role;
    protected $_ativacao;
    protected $_status;

    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value) {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        $this->$method($value);
    }

    public function __get($name) {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        return $this->$method();
    }
    
    public function setNome($text) {
        $this->_nome = (string) $text;
        return $this;
    }

    public function getNome() {
        return $this->_nome;
    }

    public function setEmail($text) {
        $this->_email = (string) $text;
        return $this;
    }

    public function getEmail() {
        return $this->_email;
    }

    public function setSenha($text) {
        $this->_senha = (string) $text;
        return $this;
    }

    public function getSenha() {
        return $this->_senha;
    }

    public function setId($text) {
        $this->_id = (string) $text;
        return $this;
    }

    public function getId() {
        return $this->_id;
    }
    
    public function setRole($text) {
        $this->_role = (string) $text;
        return $this;
    }

    public function getRole() {
        return $this->_role;
    }
    
    public function setAtivacao($text) {
        $this->_ativacao = (string) $text;
        return $this;
    }

    public function getAtivacao() {
        return $this->_ativacao;
    }
    
    public function setStatus($text) {
        $this->_status = (string) $text;
        return $this;
    }

    public function getStatus() {
        return $this->_status;
    }
}
