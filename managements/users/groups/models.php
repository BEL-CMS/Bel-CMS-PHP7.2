<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
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
#   TABLE_GROUPS
#-> id, name, id_group
class ModelGroups
{
	public function sendnew ($data)
	{
		if (empty($data['name'])) {
			$return['text']  = GROUP_NAME_EMPTY;
			$return['type']  = 'warning';
			return $return;
		}

		$test = New BDD();
		$test->table('TABLE_GROUPS');
		$test->where(array('name' => 'name', 'value' => $data['name']));
		$test->count();
		$returnCheckName = (int) $test->data;
		if ($returnCheckName >= 1) {
			$return['text']  = GROUP_NAME_RESERVED;
			$return['type']  = 'warning';
			return $return;
		}

		$sql = New BDD();
		$sql->table('TABLE_GROUPS');
		$sql->orderby(array(array('name' => 'id', 'type' => 'DESC')));
		$sql->queryOne();
		$lastid = $sql->data->id_group +1;


		$insert = New BDD();
		$insert->table('TABLE_GROUPS');
		$d['name']     = Common::VarSecure($data['name']);
		$d['color']    = Common::VarSecure($data['color']);
		$d['id_group'] = Common::SecureRequest($lastid);
		$insert->sqldata($d);
		$insert->insert();
		# check insert new group
		if ($insert->rowCount == 1) {
			$return['text']	= GROUP_SEND_SUCCESS;
			$return['type']	= 'success';
		} else {
			$return['text']	= GROUP_ERROR_SUCCESS;
			$return['type']	= 'error';
		}
		return $return;
	}

	public function delete ($id)
	{
		if (is_numeric($id)) {
			// SECURE DATA
			$id = (int) $id;
			// SQL DELETE
			$sql = New BDD();
			$sql->table('TABLE_GROUPS');
			$sql->where(array('name'=>'id_group','value' => $id));
			$sql->delete();
			// SQL RETURN NB DELETE
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => DEL_GROUP_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => DEL_GROUP_ERROR
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
	public function edit ($id)
	{
		$sql = New BDD();
		$sql->table('TABLE_GROUPS');
		$sql->where(array('name' => 'id_group', 'value' => $id));
		$sql->queryOne();

		return $sql->data;
	}

	public function sendedit ()
	{
		$dir = 'uploads/groups/';

		if (!is_dir(DIR_UPLOADS.$dir)) {
		    mkdir(DIR_UPLOADS.$dir, 0777, true);
			$fopen  = fopen($dir.'index.html', 'a+');
			$fclose = fclose($fopen); 
		}

		$extensions = array('.png', '.gif', '.jpg', '.ico', '.jpeg',);
		if (!empty($_FILES['image'])) {
			Common::Upload('image', $dir, $extensions);
		}

		$d['image'] = $dir.$_FILES['image']['name'];

		$s = New BDD;
		$s->table(TABLE_GROUPS);
		$s->where(array('name' => 'id_group','value' => $_POST['id']));
		$d['name']  = Common::VarSecure($_POST['name']);
		$d['color'] = Common::VarSecure($_POST['color']);

		$s->sqldata($d);
		$s->update();

		// SQL RETURN NB DELETE
		if ($s->rowCount == 1) {
			$return = array(
				'type' => 'success',
				'text' => EDIT_GROUP_SUCCESS
			);
		} else {
			$return = array(
				'type' => 'warning',
				'text' => EDIT_GROUP_ERROR
			);
		}
		return $return;
	}
}