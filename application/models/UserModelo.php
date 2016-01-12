<?php

class Application_Model_UserModelo {

    protected $_login;
    protected $_senha;
    protected $_id;

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

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

//apagar aqui

    public function setLogin($text) {
        $this->_login = (string) $text;
        return $this;
    }

    public function getLogin() {
        return $this->_login;
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

}
