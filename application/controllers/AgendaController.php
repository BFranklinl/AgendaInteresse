<?php
class AgendaController extends Zend_Controller_Action {

    public function init() {
    }

    public function indexAction() {
        $this->view->headTitle = 'Agenda';
    }
    
    public function listAction() {
        $this->_helper->layout->disableLayout();
        $contacto = new Application_Model_ContactoMapper();
        $this->view->contactos = $contacto->listAll();
    }
    
    
    public function editAction() {
        $this->_helper->layout->disableLayout();
        $request = $this->getRequest();
        $form = new Application_Form_Agenda();
        $contactoId = $this->getRequest()->getParam('id');
        
        if ($request->isPost()) {
            $json['error'] = ERROR_FAIL;
            $this->_helper->viewRenderer->setNoRender(TRUE);
            if (!$form->isValid($request->getPost())) {
                $json['data'] = $form->getMessages();
                $this->_helper->json($json);
                return; 
            }
            $dataForm = $form->getValues();
            $telefonos = $dataForm['']['telefono'];
            
            $contacto = new Application_Model_Contacto($dataForm['']);
            $mapper  = new Application_Model_ContactoMapper();

            $respuesta = $mapper->save($contacto, $telefonos);
            
            if ($respuesta) {
                $json['error'] = ERROR_OK;
            }
            $this->_helper->json($json);
            return;
        }
        if (!empty($contactoId)) {
            $contacto = new Application_Model_Contacto();
            $mapper  = new Application_Model_ContactoMapper();
            $data = $mapper->find($contactoId, $contacto);

            $telefonos = $data['Telefono'];
            $data = $this->__normalizeData($data);
          
            $form->populate($data);
            $nuevos;
            foreach ($telefonos as $val){
                $nuevos[] = $val['tel_numero'];
            }
            $this->view->telefonos = $nuevos;
        }
        
        $this->view->form = $form;
    }
    
    protected function __normalizeData($array) {
        $newArray = array(
            'id' => $array['Contacto']['contacto_id'],
            'nombre' => $array['Contacto']['cont_nombre'],
            'correoElectronico' => $array['Contacto']['cont_correo_electronico'],
            'calle' => $array['Contacto']['cont_calle'],
            'colonia' => $array['Contacto']['cont_colonia'],
            'numInt' => $array['Contacto']['cont_num_int'],
            'numExt' => $array['Contacto']['cont_num_ext'],
            'delegacion' => $array['Contacto']['cont_delegacion'],
            'entidadFederativa' => $array['Contacto']['cont_entidad_federativa'],
            'pais' => $array['Contacto']['cont_pais'],  
        );
        return $newArray;
    }
}

