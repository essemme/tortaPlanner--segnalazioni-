<?php
class Evento extends AppModel {
	var $name = 'Evento';
	var $displayField = 'che_cosa';
        
	var $validate = array(
		'che_cosa' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a valid che cosa',
				//'allowEmpty' => true,
				//'required' => true,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	var $hasMany = array(
		'Appuntamento' => array(
			'className' => 'Appuntamento',
			'foreignKey' => 'evento_id',
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
                'CategorieEventi' => array(
			'className' => 'CategorieEventi',
			'foreignKey' => 'evento_id',
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
	);


	var $hasAndBelongsToMany = array(
		'Categoria' => array(
                        //'with' => 'CategorieEventi',
			'className' => 'Categoria',
			'joinTable' => 'categorie_eventi',
			'foreignKey' => 'evento_id',
			'associationForeignKey' => 'categoria_id',
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

}