<?php
class Edizione extends AppModel {
	var $name = 'Edizione';
	var $displayField = 'data_uscita';
	var $validate = array(
		'data_uscita' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'Please enter a valid data uscita',
				'allowEmpty' => false,
				'required' => true,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	
	);

	var $belongsTo = array(
		'CategorieEventi' => array(
			'className' => 'CategorieEventi',
			'foreignKey' => 'categorieeventi_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
//		'Evento' => array(
//			'className' => 'Evento',
//			'foreignKey' => 'evento_id',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		)
	);
}