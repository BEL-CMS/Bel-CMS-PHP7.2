<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.1
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2022 Bel-CMS
 * @author Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
#   TABLE_USERS
#-> id, author, ip, date, reason
class ModelsBan
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
		$return = array();
		$author = Common::VarSecure($data['author'], '');
		$reason = Common::VarSecure($data['reason'], 'html');
		$date   = $data['date'];

		if ($author and ctype_alnum($author)):
			$where = array('name' => 'hash_key', 'value' => $author);
			$sql = New BDD;
			$sql->table('TABLE_USERS');
			$sql->where($where);
			$sql->queryOne();
			$return = $sql->data;
		endif;
		
		if (!empty($return)):
			if ($return->god === 0):
				$return = self::addBan ($author, $reason, $date, $return->ip);
				return $return;
			else:
				$return = array(
					'type' => 'error',
					'text' => 'Impossible de supprimé un Admin suprême de niveau 1 (compte crée a l\'install)'
				);
			endif;
		else:
		$return = array(
			'type' => 'error',
			'text' => 'Aucune donnée transmise'
		);			
		endif;
		return $return;
	}

	private function addBan ($author,$reason,$date,$ip)
	{
		$insert['author'] = $author;
		$insert['reason'] = $reason;
		$insert['date']   = $date;
		$insert['ip']     = $ip;
		// BDD return count (0 or 1);
		$sql = New BDD;
		$sql->table('TABLE_BAN');
		$sql->sqlData($insert);
		$sql->insert();
		// SQL RETURN NB INSERT
		if ($sql->rowCount == 1):
			$return = array(
				'type' => 'success',
				'text' => 'SUCCESS'
			);
		else:
			$return = array(
				'type' => 'warning',
				'text' => 'ERROR'
			);
		endif;
		return $return;
	}

	public function getKey ()
	{
		$sql = New BDD;
		$sql->table('TABLE_KEY_GOLD');
		$sql->queryOne();
		$return = $sql->data;

		return $return;	
	}

	public function getUsersBan ()
	{
		$return = array();
		$sql = New BDD;
		$sql->table('TABLE_BAN');
		$sql->queryAll();
		$return = $sql->data;
		return $return;
	}

	public function del ($hash_key)
	{
		$return   = array();
		$valid = Common::hash_key($hash_key);

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