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

	public function getCat ()
	{
		$sql = New BDD();
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
}