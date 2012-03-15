<?php
class Appuntamento extends AppModel {
	var $name = 'Appuntamento';
	var $displayField = 'cosa';
        var $order = 'Appuntamento.id ASC';
        var $virtualFields  = array(
            'tra_quanti_giorni' => 'TO_DAYS(Appuntamento.data_inizio) - TO_DAYS(NOW())',
        );
	var $validate = array(
		'evento_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please enter a valid evento id',
				//'allowEmpty' => true,
				//'required' => true,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
//		'cosa' => array(
//			'notempty' => array(
//				'rule' => array('notempty'),
//				'message' => 'Please enter a valid cosa',
//				//'allowEmpty' => true,
//				//'required' => true,
//				//'last' => true, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
		'data_inizio' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'Please enter a valid data inizio',
				//'allowEmpty' => true,
				//'required' => true,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	var $belongsTo = array(
		'Evento' => array(
			'className' => 'Evento',
			'foreignKey' => 'evento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        
}