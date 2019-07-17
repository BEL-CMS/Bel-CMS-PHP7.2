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

	public function sendparameter ($data)
	{
		$return = array();

		if (!empty($data) && is_array($data)) {
			$opt                  = array('MAX_MSG' => $data['MAX_MSG'], 'JS' => $data['JS'], 'CSS' => $data['CSS']);
			$upd['config']        = Common::transformOpt($opt, true);
			$upd['title']         = Common::VarSecure($data['title'], '');
			$upd['groups_access'] = implode("|", $data['groups']);
			$upd['groups_admin']  = implode("|", $data['admin']);
			$upd['active']        = isset($data['active']) ? 1 : 0;
			if ($data['pos'] == 'top') {
				$upd['pos'] = 'top';
			} else if ($data['pos'] == 'bottom') {
				$upd['pos'] = 'bottom';
			} else if ($data['pos'] == 'left') {
				$upd['pos'] = 'left';
			} else if ($data['pos'] == 'right') {
				$upd['pos'] = 'right';
			} else {
				$upd['pos'] = 'right';
			}
			$upd['pages']  = implode("|", $data['pages']);
			// SQL UPDATE
			$sql = New BDD();
			$sql->table('TABLE_WIDGETS');
			$sql->where(array('name' => 'name', 'value' => 'shoutbox'));
			$sql->sqlData($upd);
			$sql->update();
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => EDIT_SHOUTBOX_PARAM_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => EDIT_SHOUTBOX_PARAM_ERROR
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
}
