<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
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

class ModelsShoutbox
{
	public function getAllMsg ()
	{
		$return = array();

		$sql = New BDD;
		$sql->table('TABLE_SHOUTBOX');
		$sql->queryAll();

		if ($sql->data) {
			$return = $sql->data;
		}

		return $return;
	}

	public function getNbMsg ()
	{
		$return = 0;

		$sql = New BDD();
		$sql->table('TABLE_SHOUTBOX');
		$sql->count();

		if (!empty($sql->data)) {
			$return = $sql->data;
		}

		return $return;
	}

	public function getMsg ($id = false)
	{
		$return = array();

		if ($id) {
			$sql = New BDD();
			$sql->table('TABLE_SHOUTBOX');
			$request = Common::secureRequest($id);
			if (is_numeric($id)) {
				$sql->where(array(
					'name'  => 'id',
					'value' => $request
				));
			}
			$sql->queryOne();
			if (!empty($sql->data)) {
				$author = $sql->data->hash_key;
				$sql->data->username = Users::hashkeyToUsernameAvatar($author);
				$sql->data->avatar   = Users::hashkeyToUsernameAvatar($author, 'avatar');
				$return = $sql->data;
			}
		}
		return $return;
	}

	public function sendEdit ($data = false)
	{
		if ($data !== false) {
			// SECURE DATA
			$edit['msg'] = Common::VarSecure($data['msg'], ''); // autorise que du texte
			// SQL UPDATE
			$sql = New BDD();
			$sql->table('TABLE_SHOUTBOX');
			$id = Common::SecureRequest($data['id']);
			$sql->where(array('name' => 'id', 'value' => $id));
			$sql->sqlData($edit);
			$sql->update();
			// SQL RETURN NB UPDATE
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => EDIT_SHOUTBOX_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => EDIT_SHOUTBOX_ERROR
				);
			}
		} else {
			$return = array(
				'type' => 'warning',
				'text' => ERROR_NO_DATA
			);
		}

		return $return;
	}

	public function delete ($data = false)
	{
		if ($data !== false) {
			// SECURE DATA
			$delete = (int) $data;
			// SQL DELETE
			$sql = New BDD();
			$sql->table('TABLE_SHOUTBOX');
			$sql->where(array('name'=>'id','value' => $delete));
			$sql->delete();
			// SQL RETURN NB DELETE
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => DEL_SHOUTBOX_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => DEL_SHOUTBOX_ERROR
				);
			}
		} else {
			$return = array(
				'type' => 'error',
				'text' => ERROR_NO_DATA
			);
		}
		return $return;
	}

	public function deleteAll ()
	{
		// SQL DELETE
		$sql = New BDD();
		$sql->table('TABLE_SHOUTBOX');
		$sql->delete();
		// SQL RETURN NB DELETE
		if ($sql->rowCount <= 1) {
			$return = array(
				'type' => 'success',
				'text' => DEL_ALL_SHOUTBOX_SUCCESS
			);
		} else {
			$return = array(
				'type' => 'warning',
				'text' => DEL_ALL_SHOUTBOX_ERROR
			);
		}

		return $return;
	}
}
