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

class ModelsDownloads
{
	#####################################
	# Infos tables
	#####################################
	# TABLE_DOWNLOADS
	# TABLE_DOWNLOADS_CAT
	#####################################
	public function getAllDl ()
	{
		$sql = New BDD();
		$sql->table('TABLE_DOWNLOADS');
		$sql->queryAll();
		return $sql->data;
	}

	public function getDL ($id = null)
	{
		if ($id != null && is_numeric($id)) {
			$sql = New BDD;
			$sql->table('TABLE_DOWNLOADS');
			$where = (array('name' => 'id', 'value' => $id));
			$sql->where($where);
			$sql->queryOne();
			return $sql->data;
		} else {
			return (object) array();
		}
	}

	public function getCat ($id = null)
	{
		$sql = New BDD();
		if ($id != null && is_numeric($id)) {
			$where = array(
				'name'  => 'id',
				'value' => $id
			);
			$sql->where($where);
		}
		$sql->table('TABLE_DOWNLOADS_CAT');
		$sql->queryAll();
		return $sql->data;
	}

	public function testName ($name)
	{
		$sql = New BDD();
		$sql->table('TABLE_DOWNLOADS_CAT');
		$where = array(
			'name'  => 'name',
			'value' => $name
		);
		$sql->where($where);
		$sql->queryAll();
		if ($sql->rowCount != 0) {
			return false;
		} else {
			return true;
		}
	}

	public function sendnewcat ($data)
	{
		if ($data !== false) {
			// SECURE DATA
			$send['name']              = Common::VarSecure($data['name'], ''); // autorise que du texte
			$send['description']       = Common::VarSecure($data['description'], 'html'); // autorise que les balises HTML
			$data['groups']            = isset($data['groups']) ? $data['groups'] : array(1);
			$send['groups']            = implode("|", $data['groups']);
			$send['banner']            = isset($data['banner']) ? $data['banner'] : null;
			$send['ico']               = isset($data['ico']) ? $data['ico'] : null;
			// SQL INSERT
			$sql = New BDD();
			$sql->table('TABLE_DOWNLOADS_CAT');
			$sql->sqlData($send);
			$sql->insert();
			// SQL RETURN NB INSERT
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => SEND_NEWCAT_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => SEND_NEWCAT_ERROR
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

	public function sendeditcat ($data)
	{
		$id                  = (int) $data['id'];
		$send['name']        = Common::VarSecure($data['name'], null);
		$send['description'] = Common::VarSecure($data['description'], 'html');
		$send['groups']      = implode('|', $data['groups']);

		// SQL UPDATE
		$sql = New BDD();
		$sql->table('TABLE_DOWNLOADS_CAT');
		$sql->sqlData($send);
		$sql->where(array('name' => 'id', 'value' => $id));
		$sql->update();
		// SQL RETURN NB UPDATE == 1
		if ($sql->rowCount == 1) {
			$return = array(
				'type' => 'success',
				'text' => SEND_EDITCAT_SUCCESS
			);
		} else {
			$return = array(
				'type' => 'warning',
				'text' => SEND_EDITCAT_ERROR
			);
		}

		return $return;
	}

	public function delcat ($data = null)
	{
		if ($data !== null && is_numeric($data)) {
			// SECURE DATA
			$delete = (int) $data;
			// SQL DELETE
			$sql = New BDD();
			$sql->table('TABLE_DOWNLOADS_CAT');
			$sql->where(array('name'=>'id','value' => $delete));
			$sql->delete();
			// SQL RETURN NB DELETE
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => DEL_CAT_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => DEL_CAT_ERROR
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

	public function sendparameter($data = null)
	{
		if ($data !== false) {
			$data['admin']        = isset($data['admin']) ? $data['admin'] : array(1);
			$data['groups']       = isset($data['groups']) ? $data['groups'] : array(1);
			$upd['active']        = isset($data['active']) ? 1 : 0;
			$upd['access_admin']  = implode("|", $data['admin']);
			$upd['access_groups'] = implode("|", $data['groups']);
			// SQL UPDATE
			$sql = New BDD();
			$sql->table('TABLE_PAGES_CONFIG');
			$sql->where(array('name' => 'name', 'value' => 'downloads'));
			$sql->sqlData($upd);
			$sql->update();
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => EDIT_DL_PARAM_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => EDIT_DL_PARAM_ERROR
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

	public function sendadd ($data)
	{
		$insert['name']        = Common::SecureRequest($data['name']);
		$insert['description'] = Common::VarSecure($data['description'], 'html');
		$insert['idcat']       = (int) $data['idcat'];
		$insert['size']        = filesize($_FILES['download']['tmp_name']);
		$insert['uploader']    = $_SESSION['USER']['HASH_KEY'];
		$insert['ext']         = substr($_FILES['download']['name'], -3);
		$insert['view']        = 0;
		$insert['dls']         = 0;

		if (isset($_FILES['screen'])) {
			$screen = Common::Upload('screen', 'downloads'.DS.'screen', array('.png', '.gif', '.jpg', '.jpeg'));
			if ($screen = UPLOAD_FILE_SUCCESS) {
				$insert['screen'] = 'uploads'.DS.'downloads'.DS.'screen'.DS.$_FILES['screen']['name'];
			}
		} else {
			$insert['screen'] = '';
		}
		$dl = Common::Upload('download', 'downloads', array('.png', '.gif', '.jpg', '.jpeg', '.doc', '.txt', '.pdf', '.rar', '.zip', '.7zip', '.exe','.rtf'));
		if ($dl = UPLOAD_FILE_SUCCESS) {
			$insert['download'] = 'uploads'.DS.'downloads'.DS.$_FILES['download']['name'];
		}

		$sql = New BDD();
		$sql->table('TABLE_DOWNLOADS');
		$sql->sqlData($insert);
		$sql->insert();

		$return = array(
			'type' => 'success',
			'text' => ADD_FILE_SUCCESS
		);
		return $return;
 	}

	public function del ($data = null)
	{
		if ($data !== null && is_numeric($data)) {
			// SECURE DATA
			$delete = (int) $data;
			// SQL DELETE
			$sql = New BDD();
			$sql->table('TABLE_DOWNLOADS');
			$sql->where(array('name'=>'id','value' => $delete));
			$sql->delete();
			// SQL RETURN NB DELETE
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => DEL_FILE_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => DEL_FILE_ERROR
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
}