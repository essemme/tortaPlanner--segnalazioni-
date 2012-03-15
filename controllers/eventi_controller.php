<?php
class EventiController extends AppController {

	var $name = 'Eventi';
        var $paginate = array(
            'order' => 'Evento.id DESC', 
            'contain' => array(
                'Appuntamento' => array(
                    'order' => 'Appuntamento.data_inizio ASC'
                    ),
                'Categoria' => array(
                    'order' => 'Categoria.id ASC'
                    )
                )
            );
        
        function prossimi($categoria_id = null, $data = null) {// $year = null, $month=null, $day = null) {
            
            if(isset($this->data)) {
                $categoria_id   = $this->data['Evento']['categoria'];
                $data           = $this->data['Evento']['data'];
                $this->Session->write('data_scelta', $data);                
            } else {
//                if(isset($year)) {
//                    $data = $year.'-'.$month.'-'.$day;
//                }
                if(isset($data)) $this->Session->write('data_scelta', $data);
            }
            
            if( $categoria_id == 'all') $categoria_id ='%%';

            if( is_null($data) ) $data = date('Y-m-d');
            if( is_null($categoria_id)) $categoria_id ='%%';
            $this->Evento->Appuntamento->recursive = 1;
            
            if($categoria_id =='%%') {
                //tutte le categorie
                
                $appuntamenti = $this->Evento->Appuntamento->find('all',array(
    //                'link' => array(
    //                    'EventoFilter' => array(
    //                        'class' => 'Evento',
    //                        'conditions'	=> 'Appuntamento.evento_id = EventoFilter.id',
    //                        'CategorieEventi' => array(
    //                            'class' => 'CategorieEventi',
    //                            'conditions'	=> 'EventoFilter.id = CategorieEventi.evento_id',
    //                            'fields' => array('Evento.id')
    //                            ) 
    //                        )
    //                    ),
                    'contain' => array(
                        'Evento' => array(
                            //'CategorieEventi' => array('Edizione'),
                            'Categoria' => array(            

                                'order' => 'Categoria.id ASC',
    //                            'conditions' => array(
    //                                'Categoria.id LIKE ' => $categoria_id
    //                                )                            
                                )

                            ),

                        ),
                    'order' => array('Appuntamento.data_inizio' => 'ASC'),// 'CategorieEventi.categoria_id' => 'ASC'),
                    'conditions' => array(
                        'Appuntamento.data_inizio >= ' => $data,
                        ),
                    'limit' => 400                
                    )
                );
                } else {
                    //categoria specifica

                $appuntamenti = $this->Evento->find('all',array(
    //                'link' => array(
    //                    'Evento' => array(
    //                        'class' => 'Evento',
    //                        'conditions'	=> 'Appuntamento.evento_id = Evento.id',
    //                        'CategorieEventi' => array(
    //                            'class' => 'CategorieEventi',
    //                            'conditions'	=> 'Evento.id = CategorieEventi.evento_id'
    //                            ) 
    //                        )
    //                    ),
                    'link' => array(        
                            'Appuntamento' => array(
                                'class' => 'Appuntamento',
                                'conditions' => 'Evento.id = Appuntamento.evento_id',
                                //'fields' => array('Appuntamento.data_inizio')
                                ), // => array('Edizione'),
                            'CategorieEventi' => array(
                                'class' => 'CategorieEventi',
                                'conditions' => 'Evento.id = CategorieEventi.evento_id',
                                'fields' => array('Evento.id'),
    //                            'Edizione'  => array(
    //                                'class' => 'Edizione',
    //                                'conditions' => 'Edizione.categorieeventi_id = CategorieEventi.id',
    //                                )  
                                ),

                        ),
                    'contain' => array(              
                                'Categoria' => array(                        
                                //'order' => 'Categoria.id ASC',
    //                            'conditions' => array(
    //                                'Categoria.id LIKE ' => $categoria_id
    //                                )                            
                                ),
                        ),
                    'order' => array('Appuntamento.data_inizio' => 'ASC', 'CategorieEventi.categoria_id' => 'ASC'),
                    'conditions' => array(
                        'Appuntamento.data_inizio >= ' => $data,
                        'CategorieEventi.categoria_id LIKE ' => $categoria_id
                        ),
                    'limit' => 400

                    )
                );
                foreach($appuntamenti as $aid => $appuntamento) {
                    $appuntamenti[$aid]['Evento']['Categoria'] = $appuntamento['Categoria'];
                    unset($appuntamento['Categoria']);
                }

                
            }
            /*
             * @TODO: altra query per edizioni, cercando quelle per cui categorieeventi_id in..
             * E in vista "prossimi.ctp" fare una tabellina con i vari risultati sotto le singole categorie 
             * 
             */
            
            App::import('Core','Set');
//            $categorieeventi_presenti = Set::extract('{n}.Evento.Categoria.{n}.CategorieEventi.id',$appuntamenti);
            $categorieeventi_presenti = null;
            foreach ($appuntamenti as $appuntamento) {
                foreach($appuntamento['Evento']['Categoria'] as $categorieassociate)
                  $categorieeventi_presenti[] =  $categorieassociate['CategorieEventi']['id'];
            }  
            
            $Edizione = ClassRegistry::init('Edizione');
            $numeri_presenti = $Edizione->find('all', array(
                    'conditions' => array('categorieeventi_id' => $categorieeventi_presenti),
                    'order' => 'categorieeventi_id, data_uscita'
                    )
            );
//            $ids = $idcat = Set::extract('{n}.Edizione.id',$numeri_presenti);
//            $idcat = Set::extract('{n}.Edizione.categorieeventi_id',$numeri_presenti);
//            $date_uscita = Set::extract('{n}.Edizione.data_uscita',$numeri_presenti);
            //$numeri_presenti = array_combine($idcat, $date_uscita);
            
            $lista_categorie = $this->Evento->Categoria->find('list', array('order' => 'id'));
            $this->set(compact('appuntamenti', 'categoria_id', 'data', 'lista_categorie', 'numeri_presenti') );
            $this->data['Evento']['data'] = $data;
                        
        }
        
        
	function index() {
		$this->Evento->recursive = 1;
		$eventi = $this->paginate();
		$this->set(compact('eventi'));
	}

	function view($id = null) {
            
		if (!$id) {
			$this->Session->setFlash(__('Invalid evento', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('evento', $this->Evento->find('first', array(
                    'contain' => array(
                        'Appuntamento' => array(
                            'order' => 'Appuntamento.data_inizio ASC'
                            ),
                        'Categoria' => array(
                            'order' => 'Categoria.id ASC',                            
                            )
                        ),
                    'conditions' => array('Evento.id' => $id))
                    )
                );
//                debug($this->Evento);
//                debug($this->Evento->CategorieEventi);
                
                $Edizione = ClassRegistry::init('Edizione');
                
                $edizioni = $Edizione->find('all', array(
                    'recursive' => 2,
                    'conditions' => array('CategorieEventi.evento_id' => $id),
                    'order'      => array('data_uscita ASC'),
                    'contain'    => array('CategorieEventi' => array('Categoria'))
                    )
                );
                $this->set('edizioni', $edizioni);
                
                $categorie = $this->Evento->CategorieEventi->find('all', array(
                    'contain' => array('Categoria' => array('conditions' =>array('ha_edizioni' => 1) )), 
                    'conditions' => array('CategorieEventi.evento_id' => $id),
                    'recursive' => 1
                    )
                );
                $categorie_possibili = array();
                foreach($categorie as $categoria) {
                    $categorie_possibili[$categoria['CategorieEventi']['id']] = $categoria['Categoria']['categoria']; 
                }
                
                $this->set('categorie_possibili', $categorie_possibili);
	}

	function add() {
            //aggiungere data inziio e data fine; -> autometicamente appuntamenti..
            // in index, add date aggiuntive
		if (!empty($this->data)) {
			$this->Evento->create();
                        //$this->data['Appuntamento'][0]['cosa'] = $this->data['Evento']['che_cosa'];
			if ($this->Evento->saveAll($this->data)) {
				$this->Session->setFlash(__('The evento has been saved', true));
				$this->redirect( array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evento could not be saved. Please, try again.', true));
			}
		}
		$categorie = $this->Evento->Categoria->find('list', array('order' => 'id ASC'));
		$this->set(compact('categorie'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid evento', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Evento->save($this->data)) {
				$this->Session->setFlash(__('The evento has been saved', true));
				$this->redirect('/eventi/view/'.$id);
			} else {
				$this->Session->setFlash(__('The evento could not be saved. Please, try again.', true));
			}
		}
                $this->Evento->recursive = 1;
		if (empty($this->data)) {
			$this->data = $this->Evento->find('first', array(
                            'contain' => array(
                                'Appuntamento' => array(
                                    'order' => 'Appuntamento.data_inizio ASC'
                                    ),
                                'Categoria' => array(
                                    'order' => 'Categoria.id ASC'
                                    )
                                ),
                            'conditions' => array('Evento.id' => $id))
                            );
		}
                
		//$categorie = $this->Evento->Categoria->find('list');
		//$this->set(compact('categorie'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for evento', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Evento->delete($id)) {
			$this->Session->setFlash(__('Evento deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Evento was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
