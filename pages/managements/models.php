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

class ModelsManagements
{
	#####################################
	# Infos tables
	#####################################
	# TABLE_CONFIG
	# TABLE_USERS
	# TABLE_USERS_PROFILS
	# TABLE_USERS_SOCIAL
	# TABLE_MAINTENANCE
	#####################################
	#########################################
	# recupere la configuration
	#########################################
	public function getConfig ()
	{

		$sql = New BDD();
		$sql->table('TABLE_CONFIG');
		$sql->orderby(array(array('name' => 'name', 'type' => 'DESC')));
		$sql->queryAll();

		foreach ($sql->data as $key => $value) {
			$return[$value->name] = $value->value;
		}
		
		return $return;	
	}
	#########################################
	# Recupere les utilisateurs
	#########################################
	public function getAllUsers ($id = null)
	{
		$sql = New BDD;
		$sql->table('TABLE_USERS');
		if ($id != null && is_numeric($id)) {
			$sql->where(array('name' => 'id', 'value' => $id));
		}
		$sql->queryAll();
		$return = $sql->data;

		return $return;
	}
	#########################################
	# Maintennance
	#########################################
	public function getMaintenance ()
	{
		$return = array();

		$sql = New BDD;
		$sql->table('TABLE_MAINTENANCE');
		$sql->queryAll();

		if ($sql->data) {
			foreach ($sql->data  as $k => $v) {
				$return[$v->name] = $v->value;
			}
		}

		return $return;
	}
	#########################################
	# Logout
	#########################################
	public static function sendLogout ()
	{
		if (isset($_SESSION['LOGIN_MANAGEMENT'])) {
			unset($_SESSION['LOGIN_MANAGEMENT']);
		}
	}
	#########################################
	# enregistre les config
	#########################################
	public function sendRG ($data = null)
	{
		foreach ($data as $k => $v) {
			$sql = New BDD();
			$sql->table('TABLE_CONFIG');
			$sql->where(array('name'=>'name','value'=>$k));
			$sql->sqlData(array('value' => $v));
			$sql->update();
			unset($sql);
		}

		$save = array(
			'type' => 'success',
			'text' => SAVE_BDD_SUCCESS
		);

		return $save;
	}
	#########################################
	# enregistre les config de maintennance
	#########################################
	public function sendRGMtn ($data = null)
	{
		if (isset($data["close"]) && ($data["close"] == 'open')) {
			$data["status"] = 'open';
		} else {
			$data["status"] = 'close';
		}

		$data["title"] = Common::VarSecure($data["title"], '');
		$data["description"] = Common::VarSecure($data['description'], 'html');

		foreach ($data as $k => $v) {
			$sql = New BDD();
			$sql->table('TABLE_MAINTENANCE');
			$sql->where(array('name'=>'name','value'=>$k));
			$sql->sqlData(array('value' => $data[$k]));
			$sql->update();
			unset($sql);
		}

		$save = array(
			'type' => 'success',
			'text' => SAVE_BDD_SUCCESS
		);

		return $save;
	}
	public function getUsers ($id = null)
	{
		$sql = New BDD;
		$sql->table('TABLE_USERS');
		if ($id != null && is_numeric($id)) {
			$sql->where(array('name' => 'hash_key', 'value' => $id));
		}
		$sql->queryOne();
		$return = $sql->data;

		return $return;
	}
	public function getUsersProfils ($id = null)
	{
		$sql = New BDD;
		$sql->table('TABLE_USERS_PROFILS');
		if ($id != null && is_numeric($id)) {
			$sql->where(array('name' => 'hash_key', 'value' => $id));
		}
		$sql->queryOne();
		$return = $sql->data;

		return $return;
	}
	public function getUsersSocial ($id = null)
	{
		$sql = New BDD;
		$sql->table('TABLE_USERS_SOCIAL');
		if ($id != null && is_numeric($id)) {
			$sql->where(array('name' => 'hash_key', 'value' => $id));
		}
		$sql->queryOne();
		$return = $sql->data;

		return $return;
	}
}