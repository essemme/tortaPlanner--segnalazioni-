<?php
/**
 * Routes Configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
Router::parseExtensions('json', 'xml', 'rss', 'ajax');
 
$Year = '[12][0-9]{3}';
$Month = '0[1-9]|1[012]';
$Day = '0[1-9]|[12][0-9]|3[01]';
$ID	= '[0-9]+';

//Router::connect('/eventi/prossimi/:year-:month-:day', array(
//    'controller' => 'eventi', 
//    'action' => 'prossimi',
//    'categoria_id' => null
//    ),
//        array(
//            'year' =>$Year, 
//            'month' => $Month,      
//            'day' => $Day, 
//            
//            'categoria_id' => null,
//            'pass' => array('categoria_id','year','month','day')
//            )
//        );
//
//Router::connect('/eventi/prossimi/:categoria_id/:year-:month-:day', array(
//    'controller' => 'eventi', 
//    'action' => 'prossimi',
//    'categoria_id' => null),
//        array(
//            'year' =>$Year, 
//            'month' => $Month,      
//            'day' => $Day, 
//            'categoria_id' => $ID, 
//            'pass' => array('categoria_id','year','month','day')
//            )
//        );
//
//Router::connect('/eventi/prossimi/:categoria_id/', array(
//    'controller' => 'eventi', 
//    'action' => 'prossimi'),
//        array(            
//            'categoria_id' => $ID, 
//            'pass' => array('categoria_id')
//            )
//        );

//Router::connect('/segnalazioni/:controller/:action/*', array('controller' => ':controller', 'action' => ':action'));
Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'start'));
Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));

/*
 * Localization
 *#!#/
App::import('Lib', 'LocalizedRouter');
LocalizedRouter::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
LocalizedRouter::localize();
/*^*/

/*
 * Asset Compress
 *#!#*/
Router::connect('/ccss/*', array('plugin' => 'asset_compress', 'controller' => 'css_files', 'action' => 'get'));
Router::connect('/cjs/*', array('plugin' => 'asset_compress', 'controller' => 'js_files', 'action' => 'get'));
/*^*/
