<?php
/**
 * Bel-CMS [Content management system]
 * @version 1.0.0
 * @link https://bel-cms.be
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2014-2019 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

final class BelCMSConfig extends Dispatcher
{
	public $return;

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
	}

	public static function GetConfigPage ($page = null)
	{
		$return = null;

		if ($page != null) {
			$page = strtolower(trim(strtolower($page)));
			$sql = New BDD;
			$sql->table('TABLE_PAGES_CONFIG');
			$sql->where(array('name' => 'name', 'value' => $page));
			$sql->queryOne();
			$return = $sql->data;
			$return->access_groups = explode('|', $return->access_groups);
			$return->access_admin  = explode('|', $return->access_admin);
			if (!empty($return->config)) {
				$return->config = Common::transformOpt($return->config);
			} else {
				$return->config = (object) array();
			}
		}

		return $return;
	}

	public static function GetConfigWidgets ($widget = null)
	{
		$return = null;

		if ($widget != null) {
			$widget = strtolower(trim(strtolower($widget)));
			$sql = New BDD;
			$sql->table('TABLE_WIDGETS');
			$sql->where(array('name' => 'name', 'value' => $widget));
			$sql->queryOne();
			$return = $sql->data;
			$return->groups_access = explode('|', $return->groups_access);
			$return->groups_admin  = explode('|', $return->groups_admin);
			$return->pages  = explode('|', $return->pages);
			if (!empty($return->config)) {
				$return->config = Common::transformOpt($return->config);
			} else {
				$return->config = (object) array();
			}
		}

		return $return;
	}

	public static function getGroups ()
	{
		$return = (object) array();

		$sql = New BDD;
		$sql->table('TABLE_GROUPS');
		$sql->fields(array('id', 'name', 'id_group', 'color', 'image'));
		$sql->queryAll();

		foreach ($sql->data as $k => $v) {
			$a = defined(strtoupper($v->name)) ? constant(strtoupper($v->name)) : ucfirst(strtolower($v->name));
			$return->$a = array('id' => $v->id_group, 'color' => $v->color, 'image' => $v->image);
		}

		return $return;
	}
}