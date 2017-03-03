<?php
class Application_Model_ContactoMapper {
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
            $this->setDbTable('Application_Model_DbTable_Contacto');
        }
        return $this->_dbTable;
    }
 
    /**
     * 
     * @param Application_Model_Contacto $contacto
     * @return boolean
     */
    public function save(Application_Model_Contacto $contacto) {
        $data = array(
            'cont_nombre'   => $contacto->__get('nombre'),
            'cont_correo_electronico' => $contacto->__get('correoElectronico'),
            'cont_calle' => $contacto->__get('calle'),
            'cont_colonia' => $contacto->__get('colonia'),
            'cont_num_int' => $contacto->__get('numInt'),
            'cont_num_ext' => $contacto->__get('numExt'),
            'cont_delegacion' => $contacto->__get('delegacion'),
            'cont_entidad_federativa' => $contacto->__get('entidadFederativa'),
            'cont_pais' => $contacto->__get('pais'),
        );
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $id = $contacto->__get('id');
        if (empty($id)) {
            $db->beginTransaction();
            try {
                $save = $this->getDbTable()->insert($data);
                $db->commit();
                return $save;
            } catch (Exception $e) {
                $db->rollback();
            }
        } else {
            $db->beginTransaction();
            try {
                $update = $this->getDbTable()->update($data, array('contacto_id = ?' => $id));
                $db->commit();
                return $update;
            } catch (Exception $e) {
                $db->rollback();
                echo $e;
            }
        }
        return false;
    }
 
    /**
     * 
     * @param int $id
     * @param Application_Model_Contacto $contacto
     * @return mixed
     */
    public function find($id, Application_Model_Contacto &$contacto) {
        $result = $this->getDbTable()->find($id);
        
        if (0 == count($result)) {
            return;
        }
        $row = $result->current()->toArray();
        $contacto->__set('id', (int) $row['contacto_id']);
        return $row;
    }
 
    /**
     * 
     * @return \Application_Model_Contacto
     */
    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        
        if (!empty($resultSet)) {
            foreach ($resultSet as $row) {
                $entry = new Application_Model_Contacto();
                $entry->setId($row->contacto_id)
                        ->setNombre($row->cont_nombre)
                        ->setCorreoElectronico($row->cont_correo_electronico);
                $entries[] = $entry;
            }
        }
        return $entries;
    }
    
    /**
     * 
     * @return \Application_Model_Contacto
     */
    public function listAll() {
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $stmt = $db->query("CALL agenda.getContactos();");
        $resultSet = $stmt->fetchAll();
        $entries   = array();
        if (!empty($resultSet)) {
            foreach ($resultSet as $row) {
                $entry = new Application_Model_Contacto();
                $entry->__set('id', (int)$row['contacto_id']);
                $entry->__set('nombre', $row['cont_nombre']);
                $entry->__set('correoElectronico', $row['cont_correo_electronico']);
                $entry->__set('calle', $row['cont_calle']);
                $entry->__set('colonia', $row['cont_colonia']);
                $entry->__set('numInt', $row['cont_num_int']);
                $entry->__set('numExt', $row['cont_num_ext']);
                $entry->__set('delegacion', $row['cont_delegacion']);
                $entry->__set('entidadFederativa', $row['cont_entidad_federativa']);
                $entry->__set('timestamp', $row['cont_timestamp']);
                $entries[] = $entry;
            }
        }
        return $entries;
    }
}

