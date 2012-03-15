<?php
class CategorieEventi extends AppModel {
	var $name = 'CategorieEventi';
	var $useTable = 'categorie_eventi';
        var $recursive = 1;

        var $hasMany = array(
                'Edizione' => array(
			'className' => 'Edizione',
			'foreignKey' => 'categorieeventi_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
        
	var $belongsTo = array(
		'Categoria' => array(
			'className' => 'Categoria',
			'foreignKey' => 'categoria_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Evento' => array(
			'className' => 'Evento',
			'foreignKey' => 'evento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        
}