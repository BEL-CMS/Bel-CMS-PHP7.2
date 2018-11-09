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

class Widgets
{
	var $vars = array();
	var $widgets = null;

	function __construct () {
		if (isset($this->models)){
			foreach($this->models as $v){
				$this->loadModel($v);
			}
		}
	}

	function set ($d) {
		$this->vars = array_merge($this->vars,$d);
	}

	function render($filename) {
		extract($this->vars);
		ob_start();
		$dir = DIR_WIDGETS.strtolower(get_class($this)).DS.$filename.'.php';
		if (is_file($dir)) {
			require_once $dir;
		} else {
			Notification::Error ('file : '.$filename.' no found', 'Error File !');
		}
		$this->widgets = ob_get_contents();
		if (ob_get_length() != 0) {
			ob_end_clean();
		}
	}

	function loadModel ($name)
	{
		debug($name);
		if (is_file(DIR_WIDGETS.strtolower(get_class($this)).DS.'models.php')) {
			require_once DIR_WIDGETS.strtolower(get_class($this)).DS.'models.php';
			$this->$name = new $name();
		} else {
			ob_start();
			Notification::Error ('file models no found<br>'.DIR_PAGES.get_class($this).DS.'models.php', 'Error File !');
			$this->widgets = ob_get_contents();
			ob_end_clean();
		}
	}
}
