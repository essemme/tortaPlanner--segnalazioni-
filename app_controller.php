<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {
	
	var $helpers = array(
		'Session',
		'BakingPlate.Plate',
		'Analogue.Analogue' => array(
			array('helper' => 'BakingPlate.HtmlPlus', 'rename' => 'Html'),
			array('helper' => 'BakingPlate.FormPlus', 'rename' => 'Form'),
			array('helper' => 'BakingPlate.PaginatorPlus', 'rename' => 'Paginator'),
		),
		'Time',
                //'Js',
		#!# 'AssetCompress.AssetCompress',
	);
	var $components = array(
		'BakingPlate.Plate',
		'Session',
		'Batch.Batch' => array(
			'actions' => array('index', 'admin_index'),
		),
		'RequestHandler',
		/* Auth Configuration */
//		'Auth' => array(
//			'fields' => array(
//				'username' => 'username', 
//				'password' => 'password',
//			),
//			'loginAction' => array('staff' => false, 'plugin' => 'users', 'controller' => 'users', 'action' => 'login'),
//			'logoutRedirect' => array('action' => 'login'),
//                        'autoRedirect' => false,
//                        'userModel' => 'Users.User',
//                        'userScope' => array('User.active' => 1),
//			'loginRedirect' => '/',
//                        'authorize' => 'controller'
//			#!# 'authorize' => 'actions', // TODO Install ACL component?
//		),/*^*/
             // 'Auth'
	);
	
	var $view = 'BakingPlate.ThemedAutoHelper';
        var $theme = 'admin';

/**
 * Convenient way to setup any var_for_layout from the controller. Simply add a key-value
 *
 * @var array
 */
	var $forLayout = array(
		'description' => '',
		'keywords' => '',
	);
	
/**
 * Specifies if an action should be under SSL
 *
 * @var mixed set to true for all controller actions, set to an array of action names for specific ones
 */
	var $secureActions = false;
	
/**
 * $_GET keyword to force debug mode. Set to false or delete to disable.
 */
	var $debugOverride = 'debug';
	
/**
 * Used to set a max for the pagination limit
 *
 * @var int
 */
    var $paginationMaxLimit = 25;
	
/**
 * This allows the enabling of debug mode even if debug is set to off. 
 * Simply pass ?debug=1 in the url
 *
 */
	function __construct() {
		if (!empty($this->debugOverride) && !empty($_GET[$this->debugOverride])) {
			Configure::write('debug', 2);
		}
		if (Configure::read('debug')) {
			// TODO: add interactive for debugkit or not
			$this->components[] = 'DebugKit.Toolbar';
			App::import('Vendor', 'DebugKit.FireCake');
		}
		parent::__construct();
	}
	
	function beforeFilter() {
//            if(!$this->Auth->user()) {
//		$this->_setAuth();
//            }
		#!# $this->_setLanguage();
		#!# $this->_setMaintenance();
            //debug($this->Auth->user());
//            $this->Auth->authError = __('Sorry, but you need to login to access this location.', true);
//            $this->Auth->loginError = __('Invalid e-mail / password combination.  Please try again', true);
            
                $Categoria = ClassRegistry::init('Categoria');
                $categorie = $Categoria->find('all', array('order' => 'id'));
                $this->set('menu_categorie', $categorie);
                if(isset($this->params['pass'][0]) && is_numeric($this->params['pass'][0])) {
                    foreach($categorie as $categoria) {
                        if($this->params['pass'][0] == $categoria['Categoria']['id']) {
                            $this->set('categoria_scelta', $categoria['Categoria']['categoria']);
                            $this->set('categoria_colore', $categoria['Categoria']['colore']);
                            break;
                        }
                            
                    }
                }
                
                $mesi = array('01' => 'gen','02' => 'feb','03' => 'mar','04' => 'apr','05' => 'mag','06' => 'giu',
		'07' => 'lug','08' => 'ago','09' => 'set','10' => 'ott','11' => 'nov','12' => 'dic');
		$this->set('mesi',$mesi);
		$this->mesi = $mesi;
	}
        
        function isAuthorized(){
            return true;
        }
	
	
/**
 * Changes the layout of the page if the prefix changes - switch to basic layout for errors
 */
	function beforeRender() {
		#!# $this->_setTheme();
	}
	
/**
 * Configure your Auth environment here
 */
	function _setAuth() {            
                        
//            $this->Auth->fields = array('username' => 'email', 'password' => 'passwd');
//            $this->Auth->loginAction = array('plugin' => 'users', 'controller' => 'users', 'action' => 'login', 'admin' => false);
//            $this->Auth->loginRedirect = '/';
//            $this->Auth->logoutRedirect = '/';
//            $this->Auth->authError = __('Sorry, but you need to login to access this location.', true);
//            $this->Auth->loginError = __('Invalid e-mail / password combination.  Please try again', true);
//            $this->Auth->autoRedirect = false;
//            $this->Auth->userModel = 'Users.User';
//            $this->Auth->userScope = array('User.active' => 1);
////		if (isset($this->Acl))
////			$this->Acl->allow($aroAlias, $acoAlias);	
////		$this->Auth->authError = __('Sorry, but you need to login to access this location.', true);
////		$this->Auth->loginError = __('Invalid e-mail / password combination.  Please try again', true);
////		$this->Auth->allow('index', 'view', 'display');
//		
//		$user = $this->Auth->user();
//		
////		if ($this->Plate->prefix('admin')) {
////			if ($user['User']['username'] == 'admin') {
////				$this->Auth->allow('*');
////			} else {
////				$this->Session->setFlash(__('Sorry, but you need to be Admin to access this location.', true));
////				$this->redirect($this->Auth->loginAction);
////			}
////		}
//		Configure::write('Site.User', $user);
	}
	
/**
 * Place your language switching logic here (if you use it)
 */
	function _setLanguage() {
		if (isset($this->params['lang']) && $this->params['lang'] == Configure::read('Languages.default'))
			$this->redirect(array('lang' => false));
		$lang = isset($this->params['lang']) ? $this->params['lang'] : Configure::read('Languages.default');
		Configure::write('Config.language', $lang);
	}

/**
 * set site into Maintenance mode but not for loggeed user - allow users to login
 */
	function _setMaintenance() {
		$user = Configure::read('Site.User') ? Configure::read('Site.User') : false;
		$mainMode = Configure::read('WebmasterTools.Maintenance');
		if(!isset($user['User']) && $this->action !== 'login') {
			if($mainMode['active']) {
				$this->Plate->loadComponent(array('WebmasterTools.Maintenance'));
				$this->Maintenance->activate($mainMode['message']);
			}
		}
	}

/**
 * Place your theme-switching logic in here
 */
	function _setTheme() {
            $this->theme = 'admin';
		// check if plate isset small fix for asset compress
		if (isset($this->Plate) && $this->Plate->prefix('admin')) {
			$this->theme = 'admin';
		} elseif (Configure::read('Config.language')) {
			$this->theme = Configure::read('Config.language');
		}
	}

/**
 * Added support for continuing localized urls
 *
 * @param string $url 
 * @param string $status 
 * @param string $exit  Sofer
 * @access public
 */
	function redirect($url, $status = null, $exit = true) {
		if (is_array($url) && !isset($url['locale']) && isset($this->params['locale'])) {
			$url['locale'] = $this->params['locale'];
		}
		parent::redirect($url, $status, $exit);
	}
}
