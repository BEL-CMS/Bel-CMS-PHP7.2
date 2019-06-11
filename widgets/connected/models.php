<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.3
 * @link http://www.bel-cms.be
 * @link http://www.stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2016 Bel-CMS
 * @author Stive - mail@stive.eu
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
