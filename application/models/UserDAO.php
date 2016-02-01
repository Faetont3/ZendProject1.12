<?php

class Application_Model_UserDAO {

    protected $_dbTable;

    public function setDbTable($dbTable) {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_User');
        }
        return $this->_dbTable;
    }

    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_UserModelo();
            $entry->setId($row->id)
                    ->setNome($row->nome)
                    ->setEmail($row->email)
                    ->setSenha($row->senha)
                    ->setRole($row->role)
                    ->setStatus($row->status);
            $entries[] = $entry;
        }
        return $entries;
    }

    public function save(Application_Model_UserModelo $userModel) {
        $data = array(
            'nome'      => $userModel->getNome(),
            'email'     => $userModel->getEmail(),
            'senha'     => $userModel->getSenha(),
            'role'      => $userModel->getRole(),
            'status'    => $userModel->getStatus(),
            'ativacao'  => $userModel->getAtivacao(),
        );

        if (null === ($id = $userModel->getId()))
            $this->getDbTable()->insert($data);
    }

    public function remove($id) {
        if ($this->getDbTable()->delete(array(
                    'id = ?' => $id,
                )))
            return true;
        else
            return false;
    }
    
    public function atualiza(Application_Model_UserModelo $userModel) {
        $data = array(
            'nome'  => $userModel->getNome(),
            'email' => $userModel->getEmail(),
            'role'  => $userModel->getRole(),
        );  
        if($this->getDbTable()->update($data, array('id=?' => $userModel->getId())))
                return true;
        else return false;
    }

    public function find($id) {        
        $userModel = new Application_Model_UserModelo();
        $result = $this->getDbTable()->find($id);

        if (0 == count($result))
            return;

        $row = $result->current();
        $userModel->setNome($row->nome)
                  ->setEmail($row->email)
                  ->setSenha($row->senha)
                  ->setId($row->id)
                  ->setRole($row->role)
                  ->setStatus($row->status)
                  ->setAtivacao($row->ativacao);

        return $userModel;
    }

    public function verificaAtivacao($ativacao) {
        $select = $this->getDbTable()->select()
                ->from('user', 'ativacao')
                ->where('ativacao = ?', $ativacao);

        if ($select > 0) {
            $data = array(
                'status' => 1,
            );
            
            $this->getDbTable()->update($data, array('ativacao=?' => $ativacao));
            
            return true;
        }
        return false;
    }
}
