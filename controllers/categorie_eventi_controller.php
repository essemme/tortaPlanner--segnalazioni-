<?php
class CategorieEventiController extends AppController {

	var $name = 'CategorieEventi';

//	function index() {
//		$this->CategorieEventi->recursive = 0;
//		$CategorieEventi = $this->paginate();
//		$categories = $this->CategorieEventi->Categoria->find('list');
//		$eventis = $this->CategorieEventi->Evento->find('list');
//		$this->set(compact('CategorieEventi', 'categories', 'eventis'));
//	}
//
//	function view($id = null) {
//		if (!$id) {
//			$this->Session->setFlash(__('Invalid categorie eventi', true));
//			$this->redirect(array('action' => 'index'));
//		}
//		$this->recursive = 1;
//		$this->set('categorieEventi', $this->CategorieEventi->read(null, $id));
//	}

	function add() {
		if (!empty($this->data)) {
			$this->CategorieEventi->create();
			if ($this->CategorieEventi->save($this->data)) {
                            $evento_id = $this->data['CategorieEventi']['evento_id'];
				$this->Session->setFlash(__('The categorie eventi has been saved', true));
				$this->redirect('/eventi/view/'.$evento_id);
			} else {
				$this->Session->setFlash(__('The categorie eventi could not be saved. Please, try again.', true));
			}
		}
                
//		$categories = $this->CategorieEventi->Categoria->find('list');
//		$eventis = $this->CategorieEventi->Evento->find('list');
//		$this->set(compact('categories', 'eventis'));
	}

//	function edit($id = null) {
//		if (!$id && empty($this->data)) {
//			$this->Session->setFlash(__('Invalid categorie eventi', true));
//			$this->redirect(array('action' => 'index'));
//		}
//		if (!empty($this->data)) {
//			if ($this->CategorieEventi->save($this->data)) {
//				$this->Session->setFlash(__('The categorie eventi has been saved', true));
//				$this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The categorie eventi could not be saved. Please, try again.', true));
//			}
//		}
//		if (empty($this->data)) {
//			$this->data = $this->CategorieEventi->read(null, $id);
//		}
//		$categories = $this->CategorieEventi->Categoria->find('list');
//		$eventis = $this->CategorieEventi->Evento->find('list');
//		$this->set(compact('categories', 'eventis'));
//	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for categorie eventi', true));
			$this->redirect($this->referer());
		}
		if ($this->CategorieEventi->delete($id)) {
			$this->Session->setFlash(__('Categorie eventi deleted', true));
			$this->redirect('/eventi/view/'.$evento_id);
		}
		$this->Session->setFlash(__('Categorie eventi was not deleted', true));
		$this->redirect($this->referer());
	}
}
