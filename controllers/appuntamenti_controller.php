<?php
class AppuntamentiController extends AppController {

	var $name = 'Appuntamenti';
//
//	function index() {
//		$this->Appuntamento->recursive = 0;
//		$appuntamenti = $this->paginate();
//		$eventi = $this->Appuntamento->Evento->find('list');
//		$this->set(compact('appuntamenti', 'eventi'));
//	}

//	function view($id = null) {
//		if (!$id) {
//			$this->Session->setFlash(__('Invalid appuntamento', true));
//			$this->redirect(array('action' => 'index'));
//		}
//		$this->recursive = 1;
//		$this->set('appuntamento', $this->Appuntamento->read(null, $id));
//	}

	function add() {
		if (!empty($this->data)) {
			$this->Appuntamento->create();
                        debug($this->data);
			if ($this->Appuntamento->save($this->data)) {
                            $evento_id = $this->data['Appuntamento']['evento_id'];
				$this->Session->setFlash(__('The appuntamento has been saved', true));
                                $referer_url = Router::parse($this->referer());
                                if($referer_url['controller'] == 'eventi' && $referer_url['action'] == 'index') {
                                    $this->redirect($this->referer ());                                    
                                }
                                else {
                                    $this->redirect('/eventi/view/' .$evento_id);
                                }
				
			} else {
				$this->Session->setFlash(__('The appuntamento could not be saved. Please, try again.', true));
                                $this->redirect($this->referer('/eventi'));
			}
		}
		//$eventi = $this->Appuntamento->Evento->find('list');
		//$this->set(compact('eventi'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid appuntamento', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
                    $evento_id = $this->data['Appuntamento']['evento_id'];
			if ($this->Appuntamento->save($this->data)) {
				$this->Session->setFlash(__('The appuntamento has been saved', true));
				$this->redirect('/eventi/view/' .$evento_id);
			} else {
				$this->Session->setFlash(__('The appuntamento could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Appuntamento->read(null, $id);
		}
		$eventi = $this->Appuntamento->Evento->find('list');
		$this->set(compact('eventi'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for appuntamento', true));
			$this->redirect($this->referer('/eventi'));
		}
		if ($this->Appuntamento->delete($id)) {
			$this->Session->setFlash(__('Appuntamento deleted', true));
			$this->redirect($this->referer('/eventi'));
		}
		$this->Session->setFlash(__('Appuntamento was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
