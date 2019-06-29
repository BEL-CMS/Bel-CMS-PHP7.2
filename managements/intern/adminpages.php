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

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class AdminPages
{
	var $active;
	var $vars = array();
	var $namepage;

	public $render = null;

	function __construct()
	{
		self::loadLang();

		if ($this->active === false) {
			self::pageOff();
		}

		if (isset($this->models)){
			foreach($this->models as $v){
				$this->loadModel($v);
			}
		}
	}
	#########################################
	# Page désactiver manuellement
	#########################################
	private function pageOff ()
	{
		ob_start();
		
		Notification::warning('La page demander n\'est pas accesible', 'Page');

		$this->render = ob_get_contents();

		if (ob_get_length() != 0) {
			ob_end_clean();
		}
		return;
	}
	#########################################
	# Enregsitre les variables dans vars
	#########################################
	function set ($d) {
		$this->vars = array_merge($this->vars,$d);
	}
	#########################################
	# Rendu de la page demander
	#########################################
	public function render ($filename)
	{
		extract($this->vars);
		ob_start();

		if (isset($_REQUEST['page']) and $_REQUEST['page'] == true) {
			$filename = MANAGEMENTS.'pages'.DS.strtolower(get_class($this)).DS.$filename.'.php';
		} else if ($_REQUEST['widgets'] == true) {
			$filename = MANAGEMENTS.'widgets'.DS.strtolower(get_class($this)).DS.$filename.'.php';
		}
		
		if (is_file($filename)) {
			require $filename;
		} else {
			Notification::error('Fichier : <strong>'.$filename.' </strong>non disponible...', 'Fichier');
		}

		$this->render = ob_get_contents();

		if (ob_get_length() != 0) {
			ob_end_clean();
		}
	}
	#########################################
	# récupère le models (BDD)
	#########################################
	private function loadModel ($name)
	{
		if (isset($_REQUEST['page']) and $_REQUEST['page'] == true) {
			$dir = MANAGEMENTS.'pages'.DS.strtolower(get_class($this)).DS.'models.php';
		} else if ($_REQUEST['widgets'] == true) {
			$dir = MANAGEMENTS.'widgets'.DS.strtolower(get_class($this)).DS.'models.php';
		}

		if (is_file($dir)) {
			require_once $dir;
			$this->$name = new $name();
		} else {
			Notification::error('Fichier models manquant', 'Models');
		}
	}
	#########################################
	# récupère le fichier lang
	#########################################
	private function loadLang ()
	{
		if (isset($_REQUEST['page']) and $_REQUEST['page'] == true) {
			$dir = MANAGEMENTS.'pages'.DS.strtolower(get_class($this)).DS.'lang'.DS.'lang.'.CMS_WEBSITE_LANG.'.php';
		} else if ($_REQUEST['widgets'] == true) {
			$dir = MANAGEMENTS.'widgets'.DS.strtolower(get_class($this)).DS.'lang'.DS.'lang.'.CMS_WEBSITE_LANG.'.php';
		}

		if (is_file($dir)) {
			require_once $dir;
		}
	}
	#########################################
	# Retourne erreur ou le texte defini
	#########################################
	function error ($title, $msg, $type)
	{
		ob_start();
		Notification::$type($msg, $title);
		$this->render = ob_get_contents();
		ob_end_clean();
	}
	#########################################
	# Retourne le debug
	#########################################
	function debug($d) {
		ob_start();
		debug($d);
		$this->render = ob_get_contents();
		ob_end_clean();
	}
	#########################################
	# Redirection
	#########################################
	function redirect ($url = null, $time = null)
	{
		if ($url === true) {
			$url = $_SERVER['HTTP_REFERER'];
			header("refresh:$time;url='$url'");
		}

		$scriptName = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

		$fullUrl = ($_SERVER['HTTP_HOST'].$scriptName);

		if (!strpos($_SERVER['HTTP_HOST'], $scriptName)) {
			$fullUrl = $_SERVER['HTTP_HOST'].$scriptName.$url;
		}

		if (!strpos($fullUrl, 'http://')) {
			if ($_SERVER['SERVER_PORT'] == 80) {
				$url = 'http://'.$fullUrl;
			} else if ($_SERVER['SERVER_PORT'] == 443) {
				$url = 'https://'.$fullUrl;
			} else {
				$url = 'http://'.$fullUrl;
			}
		}
		header("refresh:$time;url='$url'");
	}
}