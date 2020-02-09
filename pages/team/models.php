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

class ModelsTeam
{
	#####################################
	# Infos tables
	#####################################
	# TABLE_TEAM
	# TABLE_TEAM_USERS
	#####################################
	# récupère les teams
	#####################################
	public function getTeam ()
	{
		$sql = New BDD();
		$sql->table('TABLE_TEAM');
		$sql->orderby(array(array('name' => 'orderby', 'type' => 'DESC')));
		$sql->queryAll();
		foreach ($sql->data as $k => $v) {
			$sql->data[$k]->user = self::getUsersTeam($v->id);
		}
		return $sql->data;
	}
	#####################################
	# récupère les joueurs de la team
	#####################################
	public function getUsersTeam ($id)
	{
		$id = (int) $id;

		$sql = New BDD();
		$sql->table('TABLE_TEAM_USERS');
		$where = array(
			'name' => 'teamid',
			'value' => $id
		);
		$sql->where($where);
		$sql->queryAll();

		return $sql->data;
	}

}