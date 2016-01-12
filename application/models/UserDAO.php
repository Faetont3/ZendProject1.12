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
                    ->setLogin($row->login)
                    ->setSenha($row->senha);
            $entries[] = $entry;
        }
        return $entries;
    }

    public function save(Application_Model_UserModelo $userModel) {

        $data = array(
            'login' => $userModel->getLogin(),
            'senha' => $userModel->getSenha(),
        );

        if (null === ($id = $userModel->getId()))
            $this->getDbTable()->insert($data);
    }

    public function remove($id) {

        $this->getDbTable()->delete(array(
            'id = ?' => $id,
        ));
    }

    //Modificar!!
    public function atualiza(Application_Model_UserModelo $userModel) {

        //$usu = $this->find($userModel->getId());                
        $data = array(
            'login' => $userModel->getLogin(),
            'senha' => $userModel->getSenha(),
        );
        $this->getDbTable()->update($data, array('id=?' => $userModel->getId()));
    }

    public function find($id) {

        $userModel = new Application_Model_UserModelo();
        $result = $this->getDbTable()->find($id);
        if (0 == count($result))
            return;

        $row = $result->current();
        $userModel->setLogin($row->login)
                ->setSenha($row->senha)
                ->setId($row->id);

        return $userModel;
    }

}
