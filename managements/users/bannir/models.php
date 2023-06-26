<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.2
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit('<!doctype html><html><head><meta charset="utf-8"><title>BEL-CMS : Error 403 Forbidden</title><style>h1{margin: 20px auto;text-align:center;color: red;}p{text-align:center;font-weight:bold;</style></head><body><h1>HTTP Error 403 : Forbidden</h1><p>You don\'t permission to access / on this server.</p></body></html>');
}
#   TABLE_USERS
#-> id, author, ip, number, reason, author_ban
class Modelsbannir
{
	public function getUsers ()
	{
		$sql = New BDD;
		$sql->table('TABLE_USERS');
		$sql->queryAll();
		$return = $sql->data;

		return $return;
	}

	public function sendadd ($data)
	{
		$return     = array();
		$author     = Common::VarSecure($data['author']);
		$ip         = Secure::isIp($data['ip_ban']);
		$reason     = Common::VarSecure($data['reason'], 'html');
		$return     = self::addBan ($author, $ip, $reason);
		return $return;
	}

	private function addBan ($author, $ip, $reason)
	{
		$user = self::getUsersBan();
		$insert['author']	  = $author;
		$insert['ip']		  = $ip;
		$insert['reason']	  = $reason;
		$insert['author_ban'] = $_SESSION['USER']['HASH_KEY'];
		$where				  = array('name' => 'author', 'value' => $author);

		if (empty($insert['author']) and empty($insert['ip'])) {
			$return = array(
				'type' => 'warning',
				'text' => 'Aucun donnée disponible'
			);
			return $return;
		} else {
			$dataInsert['author']     = empty($insert['author']) ? '' : $insert['author'];
			$dataInsert['ip']         = empty($insert['ip']) ? '' : $insert['ip'];

			$sql = New BDD();
			$sql->table('TABLE_BAN');
			$sql->where(array('name' => 'author', 'value' => $dataInsert['author']));
			$sql->count();

			if ($sql->rowCount == 1) {
				if ($data->author == $dataInsert['author']) {
					$insert1['author']     = $dataInsert['author'];
					$insert1['number']     = self::nbCountplusOne($insert['author']);
					$insert1['author_ban'] = $insert['author_ban'];
					$insert1['effective']  = 1;
					$sqlInsert = New BDD;
					$sqlInsert->table('TABLE_BAN');
					$sqlInsert->sqlData($insert1);
					$sqlInsert->insert();
					$return = array(
						'type' => 'success',
						'text' => 'Bannissement a été fait avec succès'
					);
					return $return;
				}
			}

			if (!empty($dataInsert['ip']) and !empty($ip)) {
				if ($data->ip != $dataInsert['ip']) {
					$insert1['ip']         = $dataInsert['ip'];
					$insert2['number']     = self::nbCountplusOne($insert['author']);
					$insert2['author_ban'] = $insert['author_ban'];
					$insert2['effective']  = 1;
					$sqlInsert = New BDD;
					$sqlInsert->table('TABLE_BAN');
					$sqlInsert->sqlData($insert2);
					$sqlInsert->insert();
					$return = array(
						'type' => 'success',
						'text' => 'Bannissement a été fait avec succès'
					);
					return $return;
				}
			}

			$dataInsert['number']     = self::nbCountplusOne($insert['author']);
			$dataInsert['reason']     = $insert['reason'];
			$dataInsert['author_ban'] = $insert['author_ban'];
			$dataInsert['effective']  = 1;
			$sqlInsert = New BDD;
			$sqlInsert->table('TABLE_BAN');
			$sqlInsert->sqlData($dataInsert);
			$sqlInsert->insert();
			$return = array(
				'type' => 'success',
				'text' => 'Bannissement a été fait avec succès'
			);
			return $return;
		}
	}

	private function nbCountplusOne ($id)
	{
		$sql = New BDD();
		$sql->table('TABLE_BAN');
		$sql->where(array('name' => 'author', 'value' => $id));
		$sql->queryOne();
		$data = $sql->data->number;
		if ($data == 0) {
			$return = (int) 1;
		} else {
			$return = (int) $data +1;
		}
		return $return;
	}

	public function getUsersBan ()
	{
		$return = array();
		$sql    = New BDD;
		$sql->table('TABLE_BAN');
		$sql->queryAll();
		$return = $sql->data;
		return $return;
	}

	public function sendBan ($hash_key)
	{
		$return = null;
		$valid  = Common::hash_key ($hash_key) ? $hash_key : false;
		$edit['effective'] = (int) 1;
		$edit['number']    = self::nbCountplusOne ($valid);
		$sql = New BDD();
		$sql->table('TABLE_BAN');
		$sql->where(array('name' => 'author', 'value' => $valid));
		$sql->sqlData($edit);
		$sql->update();
		// SQL RETURN NB UPDATE
		if ($sql->rowCount == 1) {
			$return = array(
				'type' => 'success',
				'text' => 'Ban a été fait avec succès'
			);
		} else {
			$return = array(
				'type' => 'warning',
				'text' => 'Une erreur est survenue durant le processus de la sauvegarde'
			);
		}
		return $return;
	}

	public function sendDeBan ($hash_key)
	{
		$return = null;
		$valid  = Common::hash_key ($hash_key) ? $hash_key : false;
		$edit['effective'] = (int) 0;
		$sql = New BDD();
		$sql->table('TABLE_BAN');
		$sql->where(array('name' => 'author', 'value' => $valid));
		$sql->sqlData($edit);
		$sql->update();
		// SQL RETURN NB UPDATE
		if ($sql->rowCount == 1) {
			$return = array(
				'type' => 'success',
				'text' => 'Sursis a été fait avec succès'
			);
		} else {
			$return = array(
				'type' => 'warning',
				'text' => 'Une erreur est survenue durant le processus de la sauvegarde'
			);
		}
		return $return;
	}

	public function del ($hash_key)
	{
		$return = array();
		$valid  = Common::hash_key($hash_key);

		if ($valid == true):

			$sql = New BDD;
			$sql->table('TABLE_BAN');
			$sql->where(array('name' => 'author', 'value' => $hash_key));
			$sql->delete();

			if ($sql->rowCount == 1):
				$return = array(
					'type' => 'success',
					'text' => 'SUCCESS'
				);
			else:
				$return = array(
					'type' => 'warning',
					'text' => 'Erreur dans la base de donnée'
				);
			endif;
		else:
			$return = array(
				'type' => 'warning',
				'text' => 'Hash_key non valide'
			);	
		endif;
		return $return;
	}
}