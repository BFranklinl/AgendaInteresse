<?php
class Application_Model_TelefonoMapper {
    protected $_dbTable;

	/**
     * 
     * @param string $dbTable
     * @return \Application_Model_ContactoMapper
     * @throws Exception
     */
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
 
    /**
     * 
     * @return string
     */
    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Telefono');
        }
        return $this->_dbTable;
    }
 
    /**
     * 
     * @param Application_Model_Contacto $contacto
     * @return boolean
     */
    public function save(Application_Model_Telefono $telefono) {
        $data = array(
            'tel_numero' => $telefono->__get('numero'),
            'contacto_id' => $telefono->__get('contactoId')
        );
        return $this->getDbTable()->insert($data);
    }
}