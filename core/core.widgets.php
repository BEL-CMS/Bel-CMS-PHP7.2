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

	public function render ($filename)
	{
		$str = str_replace('Widget', '', get_class($this));
/*
		if (Secures::getwidgetsActive(strtolower($str)) === false) {
			Notification::warning('Page', NO_ACCESS_WIDGET);
			return false;
		}
		if (Secures::getAccessWidgets(strtolower($str)) === false) {
			Notification::infos('Page', NO_ACCESS_GROUP_WIDGET);
			return false;
		}
*/
		extract($this->vars);
		ob_start();
		$dir = DIR_WIDGETS.strtolower($str).DS.$filename.'.php';
		if (is_file($dir)) {
			include $dir;
		} else {
			Notification::Error ('file : '.$filename.' no found', 'Error File !');
		}
		$this->widgets = ob_get_contents();
		if (ob_get_length() != 0) {
			ob_end_clean();
		}
		return $this->widgets;
	}

	function loadModel ($name)
	{
		$str = str_replace('Widget', '', get_class($this));
		if (is_file(DIR_WIDGETS.strtolower($str).DS.'models.php')) {
			require_once DIR_WIDGETS.strtolower($str).DS.'models.php';
			$this->$name = new $name();
		} else {
			ob_start();
			Notification::Error ('file models no found<br>'.DIR_WIDGETS.get_class($this).DS.'models.php', 'Error File !');
			$this->widgets = ob_get_contents();
			if (ob_get_length() != 0) {
				ob_end_clean();
			}
		}
	}

	protected static function getWidgetsPos ($pos = null)
	{
		if ($pos !== null) {
			$sql = New BDD();
			$sql->table('TABLE_WIDGETS');
			$where[] = array('name' => 'active', 'value' => 1);
			$where[] = array('name' => 'pos', 'value' => $pos);
			$sql->where($where);
			$sql->orderby(array('name' => 'orderby', 'value' => 'ASC'));
			$sql->queryAll();

			return $sql->data;
		}
	}

	protected static function getControllers ($pos = null)
	{
		$widgets = array();

		$sql = self::getWidgetsPos ($pos);

		foreach ($sql as $k => $v) {
			$dir = DIR_WIDGETS.$v->name.DS.'controller.php';
			if (is_file($dir)) {
				$title = !empty($v->title) ? $v->title : $v->name;
				require_once $dir;
				$controller = 'Widget'.ucfirst($v->name);
				$widget = new $controller;
				$widget->index();
				$widgets[$title] = $widget->widgets;

			}
		}
		return $widgets;
	}

	public static function getAllWidgets($pos = null)
	{
		$renderWidgets = self::renderExtWidgts($pos);
		echo $renderWidgets;
	}

	public static function GetWidget($name = null, $pos = null, $custom = null)
	{
		if (empty($name)) {
			Notification::error('Aucun nom de widgets');
		} else {
			$sql = New BDD();
			$sql->table('TABLE_WIDGETS');
			$sql->where(array('name' => 'name', 'value' => $name));
			$sql->queryOne();
		}

		if ($sql->rowCount == 0) {
			Notification::error('Aucun Widget portant ce nom');
		}

		$data = $sql->data;

		ob_start();

		$dir = DIR_WIDGETS.$data->name.DS.'controller.php';

		if (is_file($dir)) {
			require_once $dir;
			$title = !empty($data->title) ? $data->title : $v->name;
			require_once $dir;
			$controller = 'Widget'.ucfirst($data->name);
			$widget = new $controller;
			$widget->index();
			$widgets[$title] = $widget->widgets;
		}

		if ($custom === null) {
			if ($pos === null) {
				$dir = DIR_ASSET.'widgets'.DS.'widgets.static.tpl';
			} else if ($pos == 'right' or $pos == 'top' or $pos == 'bottom' or $pos == 'top') {
				switch ($pos) {
					case 'top':
						$custom = 'templates'.DS.CMS_TPL_WEBSITE.DS.'custom'.DS.'widgets.top.tpl';
						$dir = is_file($custom) ? $custom : DIR_ASSET.'widgets'.DS.'widgets.top.tpl';
						break;

					case 'bottom':
						$custom = 'templates'.DS.CMS_TPL_WEBSITE.DS.'custom'.DS.'widgets.bottom.tpl';
						$dir = is_file($custom) ? $custom : DIR_ASSET.'widgets'.DS.'bottom.top.tpl';
						break;

					case 'left':
						$custom = 'templates'.DS.CMS_TPL_WEBSITE.DS.'custom'.DS.'widgets.left.tpl';
						$dir = is_file($custom) ? $custom : DIR_ASSET.'widgets'.DS.'left.top.tpl';
						break;

					case 'right':
						$custom = 'templates'.DS.CMS_TPL_WEBSITE.DS.'custom'.DS.'widgets.right.tpl';
						$dir = is_file($custom) ? $custom : DIR_ASSET.'widgets'.DS.'right.top.tpl';
						break;

					default:
						$custom = 'templates'.DS.CMS_TPL_WEBSITE.DS.'.custom'.DS.'widgets.static.tpl';
						$dir = is_file($custom) ? $custom : DIR_ASSET.'widgets'.DS.'static.top.tpl';
						break;
				}
			}
		} else {
			$dir = trim($custom);
		}

		$title   = $title;
		$content = $widgets[$title];
		require $dir;

		$widgets = ob_get_contents();
		ob_end_clean();
		echo $widgets;
	}

	public static function getController ($pos = null)
	{
		$widgets = array();

		$sql = self::getWidgetsPos ($pos);

		foreach ($sql as $k => $v) {
			$dir = DIR_WIDGETS.$v->name.DS.'controller.php';
			if (is_file($dir)) {
				$title = !empty($v->title) ? $v->title : $v->name;
				require_once $dir;
				$controller = 'Widget'.ucfirst($v->name);
				$widget = new $controller;
				$widget->index();
				$widgets[$title] = $widget->widgets;
			}
		}
		return $widgets;
	}

	protected static function renderExtWidgts ($pos = null)
	{
		ob_start();

		if ($pos != null) {
			if ($pos = 'right') {
				foreach (self::getControllers($pos) as $k => $v) {
					$custom = 'templates'.DS.CMS_TPL_WEBSITE.DS.'custom'.DS.'widgets.right.tpl';
					$dir = DIR_ASSET.'widgets'.DS.'widgets.right.tpl';
					$title   = $k;
					$content = $v;
					if (is_file($custom)) {
						require $custom;
					} else {
						require $dir;
					}
				}
			} else if ($pos = 'left') {
				foreach (self::getControllers($pos) as $k => $v) {
					$custom = 'templates'.DS.CMS_TPL_WEBSITE.DS.'custom'.DS.'widgets.left.tpl';
					$dir = DIR_ASSET.'widgets'.DS.'widgets.left.tpl';
					$title   = $k;
					$content = $v;
					if (is_file($custom)) {
						require $custom;
					} else {
						require $dir;
					}
				}
			} else if ($pos = 'top') {
				foreach (self::getControllers($pos) as $k => $v) {
					$custom = 'templates'.DS.CMS_TPL_WEBSITE.DS.'custom'.DS.'widgets.top.tpl';
					$dir = DIR_ASSET.'widgets'.DS.'widgets.top.tpl';
					$title   = $k;
					$content = $v;
					if (is_file($custom)) {
						require $custom;
					} else {
						require $dir;
					}
				}
			} else if ($pos = 'bottom') {
				foreach (self::getControllers($pos) as $k => $v) {
					$custom = 'templates'.DS.CMS_TPL_WEBSITE.DS.'custom'.DS.'widgets.bottom.tpl';
					$dir = DIR_ASSET.'widgets'.DS.'widgets.bottom.tpl';
					$title   = $k;
					$content = $v;
					if (is_file($custom)) {
						require $custom;
					} else {
						require $dir;
					}
				}
			} else {
				foreach (self::getControllers(null) as $k => $v) {
					$custom = 'templates'.DS.CMS_TPL_WEBSITE.DS.'custom'.DS.'widgets.static.tpl';
					$dir = DIR_ASSET.'widgets'.DS.'widgets.static.tpl';
					$title   = $k;
					$content = $v;
					if (is_file($custom)) {
						require $custom;
					} else {
						require $dir;
					}
				}	
			}
		}
		$renderWidgets = ob_get_contents();
		ob_end_clean();
		return $renderWidgets;
	}

	public static function getCssStyles ()
	{
		$return = array();

		$sql = New BDD();
		$sql->table('TABLE_WIDGETS');
		$sql->where(array('name' => 'css', 'value' => 1));
		$sql->queryAll();
		$data = $sql->data;

		if (!empty($data)) {
			foreach ($data as $k => $v) {
				$dir = 'widgets'.DS.$v->name.DS.'css'.DS.'styles.css';
				if (is_file($dir)) {
					$return[] = $dir;
				}
			}
		}

		return $return;
	}
	public static function getJsJavascript ()
	{
		$return = array();

		$sql = New BDD();
		$sql->table('TABLE_WIDGETS');
		$sql->where(array('name' => 'js', 'value' => 1));
		$sql->queryAll();
		$data = $sql->data;

		if (!empty($data)) {
			foreach ($data as $k => $v) {
				$dir = 'widgets'.DS.$v->name.DS.'js'.DS.'javascripts.js';
				if (is_file($dir)) {
					$return[] = $dir;
				}
			}
		}

		return $return;
	}
}