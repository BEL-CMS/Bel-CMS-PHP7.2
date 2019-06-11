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
			$page = trim(strtolower($page));
			$sql = New BDD;
			$sql->table('TABLE_PAGES_CONFIG');
			$sql->where(array('name' => 'name', 'value' => $page));
			$sql->fields(array('name', 'config'));
			$sql->queryOne();
			$return = $sql->data;
			$return->config = Common::transformOpt($return->config);
		}

		return $return;
	}
}