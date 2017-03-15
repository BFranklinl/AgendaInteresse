<?php

class Application_Model_DbTable_Telefono extends Zend_Db_Table_Abstract{

    protected $_name = 'telefono';
    protected $_primary = 'telefono_id';

 	protected $_referenceMap = array(
        'Contacto' => array(
            'columns' => array('contacto_id'),
            'refTableClass' => 'Application_Model_DbTable_Contacto',
            'refColumns' => array('contacto_id')
        )
    ); 
}
