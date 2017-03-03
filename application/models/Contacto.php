<?php
class Application_Model_Contacto {

    protected $_id;
    protected $_nombre;
    protected $_correoElectronico;
    protected $_calle;
    protected $_colonia;
    protected $_numInt;
    protected $_numExt;
    protected $_delegacion;
    protected $_entidadFederativa;
    protected $_pais;
    protected $_timestamp;
    
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
            throw new Exception('Propiedad inexistente para el contacto.');
        }
        $this->{$name} = $value;
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
            throw new Exception('Propiedad inexistente para el contacto.');
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

