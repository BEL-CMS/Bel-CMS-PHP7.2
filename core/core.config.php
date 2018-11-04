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

final class BelCMSConfig extends Dispatcher
{
	function __construct ()
	{
		parent::__construct();
		$return = array();

		$sql = New BDD;
		$sql->table('TABLE_CONFIG');
		$sql->fields(array('name', 'value'));
		$sql->queryAll();
		$config = $sql->data;
		unset($sql);
		foreach ($config as $k => $v) {
			$return[mb_strtoupper($v->name)] = (string) $v->value;
		}
		Common::Constant($return);

		self::GetGroups();
		self::GetLangsPages();
		self::GetLangsWidgets();
		self::getConfigPages();
		self::getConfigWidgets();
	}

	public static function getConfigPages ()
	{
		if (isset($_SESSION['pages'])) {
			unset($_SESSION['pages']);
		}
		$sql = New BDD;
		$sql->table('TABLE_PAGES_CONFIG');
		$sql->fields(array('name', 'active', 'access_groups', 'access_admin', 'config'));
		$sql->queryAll();
		$data = $sql->data;
		foreach ($data as $k => $v) {

			$_SESSION['pages'][$v->name] = (object) array(
				'active' => $v->active,
				'groups' => $v->access_groups,
				'admin'  => $v->access_admin,
			);
			$_SESSION['pages'][$v->name]->config = empty($v->config) ? '' : Common::transformOpt($v->config);
		}
		$_SESSION['pages'] = (object) $_SESSION['pages'];
		return $_SESSION['pages'];
	}

	public static function getConfigWidgets ()
	{
		if (isset($_SESSION['widgets'])) {
			unset($_SESSION['widgets']);
		}
		$return = array();

		$sql = New BDD();
		$sql->table('TABLE_WIDGETS');
		$sql->fields(array('name', 'title', 'groups_access', 'groups_admin', 'activate' , 'pos', 'orderby', 'pages'));
		$sql->queryAll();
		$results = $sql->data;
		unset($sql);

		foreach ($results as $k => $v) {
			$return[$v->name] = $v;
		}

		foreach ($return as $k => $v) {
			$return[$k]->groups_access = explode('|', $v->groups_access);
			$return[$k]->groups_admin = explode('|', $v->groups_admin);
		}

		$_SESSION['widgets'] = (object) $return;
		return $return;
	}

	private function GetLangsPages ()
	{
		if (defined('CMS_WEBSITE_LANG')) {
			$return = CMS_WEBSITE_LANG;
		} else {
			$sql = New BDD;
			$sql->table('TABLE_CONFIG');
			$sql->where(array('name' => 'name', 'value' => 'CMS_WEBSITE_LANG'));
			$sql->fields(array('name', 'value'));
			$sql->queryOne();
			Common::Constant($sql->data->name, $sql->data->value);
			unset($sql);
		}
		$fileLangBase = DIR_LANG.'langs.'.CMS_WEBSITE_LANG.'.php';
		if (is_file($fileLangBase)) {
			include $fileLangBase;
		} else {
			throw new Exception('ERROR FILE : file ['.$fileLangBase.'] no found', 2);
		}
	}

	private function GetLangsWidgets ()
	{
		if (defined('CMS_WEBSITE_LANG')) {
			$return = CMS_WEBSITE_LANG;
		} else {
			$sql = New BDD;
			$sql->table('TABLE_CONFIG');
			$sql->where(array('name' => 'name', 'value' => 'CMS_WEBSITE_LANG'));
			$sql->fields(array('name', 'value'));
			$sql->queryOne();
			Common::Constant($sql->data->name, $sql->data->value);
			unset($sql);
		}

		$sql = New BDD;
		$sql->table('TABLE_WIDGETS');
		$sql->where(array('name' => 'activate', 'value' => 1 ));
		$sql->queryAll();
		$data = $sql->data;
		if (count($data) != 0) {
			foreach ($data as $k => $v) {
				$dir = DIR_WIDGETS.mb_strtolower($v->name).DS.'lang'.DS.'lang.'.CMS_WEBSITE_LANG.'.php';
				if (is_file($dir)) {
					include $dir;
				}
			}
		}
	}

	public static function GetGroups ($reset = false)
	{
		if (isset($_SESSION['groups'])) {
			unset($_SESSION['groups']);
		}
		$return = array();

		$sql = New BDD();
		$sql->table('TABLE_GROUPS');
		$sql->fields(array('name', 'id_group'));
		$sql->queryAll();
		$results = $sql->data;
		unset($sql);

		foreach ($results as $k => $v) {
			$v->name = defined($v->name) ? constant($v->name) : (string) ucfirst($v->name);
			$return[(int) $v->id_group] = $v->name;
		}

		$_SESSION['groups'] = (object) $return;
		return $return;
	}
}