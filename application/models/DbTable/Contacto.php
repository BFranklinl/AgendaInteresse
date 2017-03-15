<?php

class Application_Model_DbTable_Contacto extends Zend_Db_Table_Abstract{

    protected $_name = 'contacto';
    protected $_primary = 'contacto_id';

    protected $_dependentTables = array('Application_Model_DbTable_Telefono');
}

