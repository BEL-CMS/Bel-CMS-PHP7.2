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

class ModelsConnected
{
	protected function GetGroups ()
	{
		$return = null;
		$sql = New BDD();
		$sql->table('TABLE_GROUPS');
		$sql->orderby(array(array('name' => 'name', 'type' => 'ASC')));
		$sql->queryAll();
		if (!empty($sql->data)) {
			$return = $sql->data;
		}
		return $return;
	}
	protected function GetUsersNb ($where = false)
	{
		$return = null;
		$sql = New BDD();
		$sql->table('TABLE_USERS');
		if ($where !== false) {
			$where = "WHERE `groups` LIKE '%".$where."%'";
			$sql->where($where);
		}
		$sql->queryAll();
		if (!empty($sql->data)) {
			$return = $sql->rowCount;
		} else {
			$return = 0;
		}
		return $return;
	}
	protected function GetConnected ()
	{
		$return = null;
		$sql = New BDD();
		$sql->table('TABLE_STATS');
		$where = "WHERE 1 and `name` in ('record','last','today')";
		$sql->where($where);
		$sql->queryAll();
		$return = $sql->data;

		foreach ($return as $k => $v) {
			$_SESSION['STATS'][$v->name] = $v->value;
		}

		return $return;
	}
	protected function NbNow ()
	{
		$sql = New BDD();
		$sql->table('TABLE_VISITORS');
		$less = strtotime("-3 minutes");
		$where = "WHERE `date_page` > '$less'";
		$sql->where($where);
		$sql->queryAll();
		$return = $sql->data;

		return $return;
	}
}
