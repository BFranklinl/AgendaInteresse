<?php

class Application_Model_Telefono {
    protected $_id;
    protected $_numero;
    protected $_contactoId;

    /**
     * 
     * @param array $options
     */
    public function __construct(array $options = null){
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
 
    /**
     * 
     * @param string $name
     * @param mixed $value
     * @throws Exception
     */
    public function __set($name, $value) {
        $name = '_' . $name;
        $vars = get_class_vars(get_class($this));
        if (('mapper' == $name) || !array_key_exists($name, $vars)) {
            throw new Exception('Propiedad inexistente para el teléfono.');
        }
        if ($name == '_id') {
            $this->{$name} = (int)$value;
        } else {
            $this->{$name} = $value;
        }
    }
 
    /**
     * 
     * @param string $name
     * @return mixed
     * @throws Exception
     */
    public function __get($name) {
        $name = '_' . $name;
        $vars = get_class_vars(get_class($this));
        if (('mapper' == $name) || !array_key_exists($name, $vars)) {
            throw new Exception('Propiedad inexistente para el teléfono.');
        }
        return $this->{$name};
    }
 
    /**
     * 
     * @param mixed $options
     * @return \Application_Model_Contacto
     */
    public function setOptions(array $options) {
        $vars = get_class_vars(get_class($this));
        foreach ($options as $key => $value) {
            if (array_key_exists('_' . $key, $vars)) {
                $this->__set($key, $value);
            }
        }
        return $this;
    }
 
}

