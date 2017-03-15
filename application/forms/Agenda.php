<?php
class Application_Form_Agenda extends Zend_Form {

    public function init() {
        $this->setMethod('post');
        
        $this->addElement('hidden', 'id', array(
            'label'      => false,
            'required'   => false,
            'filters'    => array('StringTrim'),
        ));
        
        $this->addElement('text', 'nombre', array(
            'label'      => 'Nombre',
            'required'   => true,
            'filters'    => array('StringTrim'),
        ));
 
        $this->addElement('text', 'correoElectronico', array(
            'label'      => 'Correo electrónico:',
            'required'   => true,
            'validators' => array(
                'EmailAddress',
            )
        ));
        
        $this->addElement('text', 'telefono', array(
            'label' => 'Teléfono(s):',
            'required' => false,
            'isarray' => true,
            'class' => 'form-control'
        ))->setIsArray(true);
 
        $this->addElement('text', 'calle', array(
            'label'      => 'Calle:',
            'required'   => false,
        ));
        
        $this->addElement('text', 'colonia', array(
            'label'      => 'Colonia:',
            'required'   => false,
        ));
        

        $this->addElement('text', 'numExt', array(
            'label'      => 'Número ext.:',
            'required'   => false,            
        ));
        
        $this->addElement('text', 'numInt', array(
            'label'      => 'Número int.:',
            'required'   => false,            
        ));
        
        $this->addElement('text', 'delegacion', array(
            'label'      => 'Delegación:',
            'required'   => false,            
        ));
        
        $this->addElement('text', 'entidadFederativa', array(
            'label'      => 'Entidad federativa:',
            'required'   => false,            
        ));
        
        $this->addElement('text', 'pais', array(
            'label'      => 'País:',
            'required'   => false,            
        ))->setAttrib('class', 'form-control');
 
 
        $this->setElementDecorators(array(
            'ViewHelper',
        ));

    }
}

