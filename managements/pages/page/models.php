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

class ModelsPage
{
	#####################################
	# Infos tables
	#####################################
	# TABLE_PAGE
	#####################################
	public function addNewPage ($data)
	{
		if ($data !== false) {
			// SECURE DATA
			$send['name']    = Common::VarSecure($data['name'], ''); // autorise que du texte
			$send['content'] = Common::VarSecure($data['content'], 'html'); // autorise que les balises HTML
			if (!isset($data['groups'])) {
				$send['groups'] = 0;
			} else {
				$send['groups'] = implode('|', $data['groups']);
			}
			// SQL INSERT
			$sql = New BDD();
			$sql->table('TABLE_PAGE');
			$sql->sqlData($send);
			$sql->insert();
			// SQL RETURN NB INSERT
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => SEND_PAGE_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => SEND_PAGE_ERROR
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

	public function getPages ()
	{
		$return = array();
		$sql = New BDD();
		$sql->table('TABLE_PAGE');
		$sql->queryAll();
		$return = $sql->data;
		return $return;
	}

	public function getPage ($id = false)
	{
		$return = null;

		if ($id) {

			$sql = New BDD();
			$sql->table('TABLE_PAGE');
			$where = array(
				'name'  => 'id',
				'value' => $id
			);
			$sql->where($where);
			$sql->queryOne();
			$return = $sql->data;
		}

		return $return;
	}

	public function sendedit ($data)
	{
		if ($data && is_array($data)) {
			// SECURE DATA
			$edit['name']              = Common::VarSecure($data['name'], ''); // autorise que du texte
			$edit['content']           = Common::VarSecure($data['content'], 'html'); // autorise que les balises HTML
			if (!isset($data['groups'])) {
				$edit['groups'] = 0;
			} else {
				$edit['groups'] = implode('|', $data['groups']);
			}			// SQL UPDATE
			$sql = New BDD();
			$sql->table('TABLE_PAGE');
			$id = Common::SecureRequest($data['id']);
			$sql->where(array('name' => 'id', 'value' => $id));
			$sql->sqlData($edit);
			$sql->update();
			// SQL RETURN NB UPDATE
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => EDIT_PAGE_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => EDIT_PAGE_ERROR
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