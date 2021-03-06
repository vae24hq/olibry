<?php
/* erko3™ framework - an evolving, robust platform for rapid & efficient development of modem responsive static or dynamic website.
 * Built by SlimEdge™ [@officialSEID - www.seid.com.ng] using PHP, HTML, CSS, JS & derived technology. © July 2016 | version 1.0
 * ================================================================================================================================
 * PHP | init::source ~ custom configuration & initialization | Dependency » #
 */

/**
 * ===========================================================================
 *  Begin website configuration and settings
 * ===========================================================================
 */

defined('SET_MODE') ? null : define('SET_MODE', 'development'); #[development|production|maintenance|offline]
defined('REWRITE_URL') ? null : define('REWRITE_URL', 'sure'); #[sure|nope]

//Site Settings
$config = array(
	'name'       => "Whosco Ventures Limited",
	'squat'      => "Whosco Limited",
	'brand'      => "Whosco™",
	'slogan'     => "a commitment to excellence",
	'acronym'    => "Whosco",

	'ui'     => "",
	'tag'    => "",
	'mail'   => "",
	'phone'  => "",
	'domain' => "",
	
	'admin'  => ""
);

$config['title'] = array();
$config['description'] = array();
$config['keywords'] = array();
$config['heading'] = array();


//Slideshow Information
$slideImgData = array(
	1  => array(
		"name" => "chair",
		"caption" => "A stadium contains rows of Chairs",
		"alt" => "stadium chairs"),
	2  => array(
		"name" => "swing",
		"caption" => "Children enjoy the out doors on a swing",
		"alt" => "children swing"),
	3  => array(
		"name" => "tractor",
		"caption" => "Using a tractor on a farm is mechanised farming",
		"alt" => "tractor on a farm")
	);



/**
 * ===========================================================================
 *  Begin path definition for default directory(s)
 * ===========================================================================
 */

//Separator
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('PS') ? null : define('PS', '/');


//Directory
defined('SOURCE') ? null : define('SOURCE', 'source');
	
	defined('PATH_ASSET') ? null : define('PATH_ASSET', SOURCE.PS.'asset');
		defined('PATH_CSS') ? null : define('PATH_CSS', PATH_ASSET);
		defined('PATH_FAVICON') ? null : define('PATH_FAVICON', PATH_ASSET.PS.'favicon');
		defined('PATH_IMG') ? null : define('PATH_IMG', PATH_ASSET.PS.'image');
		defined('PATH_JS') ? null : define('PATH_JS', PATH_ASSET.PS.'js');
		defined('PATH_SLIDE') ? null : define('PATH_SLIDE', PATH_IMG.PS.'slide');
		defined('PATH_UPLOAD') ? null : define('PATH_UPLOAD', PATH_ASSET.PS.'upload');

	defined('SLICE') ? null : define('SLICE', SOURCE.DS.'slice');
	defined('VIEW') ? null : define('VIEW', SOURCE.DS.'view');

defined('LIBRARY') ? null : define('LIBRARY', 'erko3');
	defined('PLUG') ? null : define('PLUG', LIBRARY.DS.'plug');
	defined('UTIL') ? null : define('UTIL', LIBRARY.DS.'utility');

defined('DIR_UPLOAD') ? null : define('DIR_UPLOAD', SOURCE.DS.'asset'.DS.'upload');



/**
 * ===========================================================================
 *  Begin default check, initialization and loading of library(s)
 * ===========================================================================
 */

//Default settings check
	#TODO [ERROR_CHECKER] - check that CONSTANTs (everything) is defined and properly set


//PHP error reporting settings
if(SET_MODE != 'development'){error_reporting(0);} else {error_reporting(E_ALL | E_STRICT);}


//Include library
require_once LIBRARY.DS.'session.php';
Session::start();

require_once LIBRARY.DS.'helper.php';
require_once LIBRARY.DS.'device.php';
require_once LIBRARY.DS.'erko.php';

// Run erko settings using custom configuration
erko::setting($config); 
?>