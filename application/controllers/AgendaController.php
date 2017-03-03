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
            $contacto = new Application_Model_Contacto($form->getValues());
            $mapper  = new Application_Model_ContactoMapper();
            if ($mapper->save($contacto)) {
                $json['error'] = ERROR_OK;
            }
            $this->_helper->json($json);
            return;
        }
        if (!empty($contactoId)) {
            $contacto = new Application_Model_Contacto();
            $mapper  = new Application_Model_ContactoMapper();
            $data = $this->__normalizeData($mapper->find($contactoId, $contacto));
            $form->populate($data);
        }
        $this->view->form = $form;
    }
    
    protected function __normalizeData($array) {
        $newArray = array(
            'id' => $array['contacto_id'],
            'nombre' => $array['cont_nombre'],
            'correoElectronico' => $array['cont_correo_electronico'],
            'calle' => $array['cont_calle'],
            'colonia' => $array['cont_colonia'],
            'numInt' => $array['cont_num_int'],
            'numExt' => $array['cont_num_ext'],
            'delegacion' => $array['cont_delegacion'],
            'entidadFederativa' => $array['cont_entidad_federativa'],
            'pais' => $array['cont_pais'],
        );
        return $newArray;
    }
}

