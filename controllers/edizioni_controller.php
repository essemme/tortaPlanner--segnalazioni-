<?php
class EdizioniController extends AppController {

	var $name = 'Edizioni';
        var $paginate = array(
            'limit' => 50,
            'order' => 'data_uscita, CategorieEventi.categoria_id, in_evidenza DESC',
            'conditions' => array('data_uscita >= DATE(NOW())' ),
            'contain' => array('CategorieEventi' => array('Categoria','Evento' => array('Appuntamento'))) // => array('Appuntamento')))
        );

	function index($categoria_id = null) {
		$this->Edizione->recursive = 1;
                if(!is_null($categoria_id)) {
                    $this->paginate['conditions']['CategorieEventi.categoria_id'] = $categoria_id;
                }
                
		$edizioni = $this->paginate();
		//$categorie = $this->Edizione->Categoria->find('list');
		//$appuntamenti = $this->Edizione->Appuntamento->find('list');
		$this->set(compact('edizioni'));
	}

	function view($categoria_id = null, $data = null) {
            
            if (!$categoria_id && !$data) {
			$this->Session->setFlash(__('Invalid edizione', true));
			$this->redirect($this->referer('/edizioni/index'));
            }
            
            $this->Edizione->recursive = 1;
                if(!is_null($categoria_id)) {
                    $this->paginate['conditions']['CategorieEventi.categoria_id'] = $categoria_id;
                }
                if(!is_null($categoria_id)) {
                    $this->paginate['conditions']['data_uscita'] = $data;
                }
                
		$edizioni = $this->paginate();
            
		$this->set('edizioni', $edizioni);
//		$this->recursive = 1;
//		$this->set('edizione', $this->Edizione->read(null, $id));
	}

	function add() {
                if (!empty($this->data)) {
                    foreach($this->data['Edizione'] as $key => $value) {
                        if(substr($key,0,11) == 'data_uscita') $this->data['Edizione']['data_uscita'] = $value;
                        //debug($key);
                        //unset($this->data['Edizione'][$key]);
                    } 
                    //debug($this->data);                    
                    
                    $return_to_anchor = $this->data['Edizione']['appuntamento_id'];
                    
			$this->Edizione->create();
			if ($this->Edizione->save($this->data)) {
				$this->Session->setFlash(__('The edizione has been saved', true));

                                $referer_url = Router::parse($this->referer());
                                if($referer_url['controller'] == 'eventi' && $referer_url['action'] == 'prossimi') {
                                    $this->redirect($this->referer().'#'.$return_to_anchor);
                                }
                                else {                                 
                                    $categorie_eventi = $this->Edizione->find('first', array(
                                        'recursive' => 0,
                                        'conditions' => array('Edizione.id' => $this->Edizione->id),
                                        'contain' => array('CategorieEventi')
                                    ));
                                    $evento_id = $categorie_eventi['CategorieEventi']['evento_id'];
                                    $this->redirect('/eventi/view/'. $evento_id);
                                }
				
			} else {
				$this->Session->setFlash(__('The edizione could not be saved. Please, try again.', true));
			}
		}
                
                
                $this->redirect($this->referer());
//		$categorie = $this->Edizione->Categoria->find('list');
//		$appuntamenti = $this->Edizione->Appuntamento->find('list');
//		$this->set(compact('categorie', 'appuntamenti'));
	}
        
//
//	function edit($id = null) {
//		if (!$id && empty($this->data)) {
//			$this->Session->setFlash(__('Invalid edizione', true));
//			$this->redirect(array('action' => 'index'));
//		}
//		if (!empty($this->data)) {
//			if ($this->Edizione->save($this->data)) {
//				$this->Session->setFlash(__('The edizione has been saved', true));
//				$this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The edizione could not be saved. Please, try again.', true));
//			}
//		}
//		if (empty($this->data)) {
//			$this->data = $this->Edizione->read(null, $id);
//		}
////		$categorie = $this->Edizione->Categoria->find('list');
////		$appuntamenti = $this->Edizione->Appuntamento->find('list');
////		$this->set(compact('categorie', 'appuntamenti'));
//	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for edizione', true));
			$this->redirect($this->referer());
		}
		if ($this->Edizione->delete($id)) {
			$this->Session->setFlash(__('Edizione deleted', true));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Edizione was not deleted', true));
		$this->redirect($this->referer());
	}
}
