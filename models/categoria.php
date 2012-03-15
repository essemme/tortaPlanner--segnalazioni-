<?php
class Categoria extends AppModel {
	var $name = 'Categoria';
	var $displayField = 'categoria';
	var $validate = array(
		'categoria' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a valid categoria',
				//'allowEmpty' => true,
				//'required' => true,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	var $hasAndBelongsToMany = array(
		'Evento' => array(
                        //'with' => 'CategorieEventi',
			'className' => 'Evento',
			'joinTable' => 'categorie_eventi',
			'foreignKey' => 'categoria_id',
			'associationForeignKey' => 'evento_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
        
        var $hasMany = array(
		
                'CategorieEventi' => array(
			'className' => 'CategorieEventi',
			'foreignKey' => 'categoria_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
//                'Edizione' => array(
//			'className' => 'Edizione',
//			'foreignKey' => 'categoria_id',
//			'dependent' => false,
//			'conditions' => '',
//			'fields' => '',
//			'order' => '',
//			'limit' => '',
//			'offset' => '',
//			'exclusive' => '',
//			'finderQuery' => '',
//			'counterQuery' => ''
//		)
	);

}