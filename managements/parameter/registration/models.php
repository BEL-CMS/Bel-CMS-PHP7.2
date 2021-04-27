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

final class ModelsUsers
{
	#####################################
	# Infos tables
	#####################################
	# TABLE_USERS
	# TABLE_USERS_PROFILS
	# TABLE_USERS_SOCIAL
	#####################################
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
	public function getAllUsersProfils ($id = null)
	{
		$sql = New BDD;
		$sql->table('TABLE_USERS_PROFILS');
		if ($id != null && is_numeric($id)) {
			$sql->where(array('name' => 'id', 'value' => $id));
		}
		$sql->queryAll();
		$return = $sql->data;

		return $return;
	}
	public function getAllUsersSocial ($id = null)
	{
		$sql = New BDD;
		$sql->table('TABLE_USERS_SOCIAL');
		if ($id != null && is_numeric($id)) {
			$sql->where(array('name' => 'id', 'value' => $id));
		}
		$sql->queryAll();
		$return = $sql->data;

		return $return;
	}

	public function sendPrivate ($data)
	{
		$sql = New BDD;
		$sql->table('TABLE_USERS');
		$sql->where(array('name' => 'hash_key', 'value' => $data['hash_key']));
		$insert['email'] = Secure::isMail($data['email']);
		$sql->sqlData($insert);
		$sql->update();
		$return = array('type' => 'success', 'text' => 'le e-mail privé à été changé', 'title' => 'Paramètre privé');
		return $return;
	}

	public function sendMainGroup ($data = null)
	{
		$update['main_groups'] = (int) $data;
		$sql = New BDD;
		$sql->table('TABLE_USERS');
		$sql->where(array('name' => 'hash_key', 'value' => $data['hash_key']));
		$sql->sqlData($update);
		$sql->update();
		$return = array('type' => 'success', 'text' => 'le groupe principal à été changer', 'title' => 'Groupe primaire');
		return $return;
	}

	public function sendSecondGroup ($data = null)
	{
		$update['groups'] = null;
		if (!empty($data)) {
			foreach ($data['second'] as $key => $value) {
				$update['groups'] .= $value.'|';
			}
		}
		$update['groups'] .= 2; // membres obligatoire

		$sql = New BDD;
		$sql->table('TABLE_USERS');
		$sql->where(array('name' => 'hash_key', 'value' => $data['hash_key']));
		$sql->sqlData($update);
		$sql->update();
		$return = array('type' => 'success', 'text' => 'les groupes secondaire ont été changer', 'title' => 'Groupe seconaire');
		return $return;
	}

	public function sendSocial ($data = null)
	{
		if ($data != null) {
			$update = New BDD();
			$update->table('TABLE_USERS_SOCIAL');
			$update->sqlData($data);
			$update->where(array('name' => 'hash_key', 'value' => $data['hash_key']));
			$update->update();
			$returnSql = $update->data;
			$resultsCount = $returnSql;

			if ($resultsCount != null) {
				$return['text']     = 'Vos informations ont été sauvegardées avec succès';
				$return['type']     = 'success';
				$return['rowcount'] = $resultsCount;
			} else {
				$return['text']  = 'Aucune informations a été sauvegardées';
				$return['type']  = 'danger';
				$return['rowcount'] = $resultsCount;
			}
			return $return;
		}
	}

	public function sendInfoPublic ($data)
	{
		if ($data && is_array($data)) {
			$update = New BDD();
			$update->table('TABLE_USERS_PROFILS');
			$update->sqlData($data);
			$update->where(array('name' => 'hash_key', 'value' => $data['hash_key']));
			$update->update();
			$returnSql = $update->data;
			$resultsCount = $returnSql;

			if ($resultsCount != null) {
				$return['text']     = 'Vos informations ont été sauvegardées avec succès';
				$return['type']     = 'success';
				$return['rowcount'] = $resultsCount;
			} else {
				$return['text']  = 'Aucune informations a été sauvegardées';
				$return['type']  = 'danger';
				$return['rowcount'] = $resultsCount;
			}
			return $return;
		}
	}
}