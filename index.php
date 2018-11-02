<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
 * @link https://bel-cms.be
 * @link https://stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2019 Bel-CMS
 * @author Stive - determe@stive.eu
 */

#########################################
# start timer
#########################################
$GLOBALS['TIME_START'] = explode(' ', microtime())[0] + explode(' ', microtime())[1];
#########################################
# Initialise TimeZone
#########################################
date_default_timezone_set("Europe/Brussels");
setlocale(LC_TIME, 'fr','fr_FR','fr_FR@euro','fr_FR.utf8','fr-FR','fra');
#########################################
# Debug
#########################################
function debug ($data = null, $exitAfter = false)
{
	echo '<pre>';
		print_r($data);
	echo '</pre>';
	if ($exitAfter === true) {
		exit();
	}
}
#########################################
# base constant
#########################################
define ('DEBUG', true);
define ('CHECK_INDEX', true);
define ('SHOW_ALL_REQUEST_SQL', false);
define('ERROR_INDEX', '<!doctype html><html lang="fr"><head><meta charset="utf-8"><title>403 Direct access forbidden</title></head><body><h1>Direct access forbidden</h1><p>The requested URL '.$_SERVER['SCRIPT_NAME'].' is prohibited.</p></body></html>');
define ('DS', '/');
define ('WEB_ROOT',str_replace('index.php','',$_SERVER['SCRIPT_NAME']));
define ('ROOT',str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));
define ('ROOT_HTML', 'templates'.DS);
define ('ROOT_HTML_DFT', 'assets'.DS.'tpl'.DS);
define ('DIR_CORE', ROOT.'core'.DS);
define ('DIR_TPL', ROOT.'templates'.DS);
define ('DIR_TPL_DEFAULT', ROOT.'assets'.DS.'template'.DS);
define ('DIR_CONFIG', ROOT.'config'.DS);
define ('DIR_PAGES', ROOT.'pages'.DS);
define ('DIR_LANG', ROOT.'assets'.DS.'langs'.DS);
define ('DIR_ASSET',ROOT.'assets'.DS);
define ('DIR_ASSET_TPL',ROOT.'assets'.DS.'tpl'.DS);
define ('DIR_WIDGETS', ROOT.'widgets'.DS);
define ('DIR_UPLOADS', ROOT.'uploads'.DS);
#########################################
# require
#########################################
require DIR_CORE.'core.error.php';
require 'file_require.php';
new RequireFiles;
#########################################
# Install
#########################################
if (is_file(ROOT.'INSTALL'.DS.'index.php')) {
	header('Location: INSTALL/index.php');
	die();
}
try {	
	$BelCMS = new BelCMS;
	$BelCMS->_init();
	echo $BelCMS->render;
} catch (Exception $e) {
	echo 'Exception reçue : ',  $e->getMessage(), "\n";
}