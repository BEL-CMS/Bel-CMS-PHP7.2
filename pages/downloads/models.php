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
	public function getCat ($id = null)
	{
		$sql = New BDD();
		$sql->table('TABLE_DOWNLOADS_CAT');

		if ($id !== null && is_numeric($id)) {
			$id = (int) $id;
			$where = array(
				'name' => 'id',
				'value' => $id
			);
			$sql->where($where);
			$sql->queryOne();
			return $sql->data;
		} else {
			$sql->queryAll();
			return $sql->data;
		}
	}

	public function getDls ($id = null)
	{
		if ($id !== null && is_numeric($id)) {
			$sql = New BDD();
			$sql->table('TABLE_DOWNLOADS');
			$id = (int) $id;
			$where = array(
				'name' => 'idcat',
				'value' => $id
			);
			$sql->where($where);
			$sql->queryAll();
			return $sql->data;
		}
	}

	public function getDlsDetail ($id = null)
	{
		if ($id !== null && is_numeric($id)) {
			$sql = New BDD();
			$sql->table('TABLE_DOWNLOADS');
			$id = (int) $id;
			$where = array(
				'name' => 'id',
				'value' => $id
			);
			$sql->where($where);
			$sql->queryAll();
			return $sql->data;
		}
	}

	public function ifAccess ($id)
	{
		if ($id !== null && is_numeric($id)) {
			$sql = New BDD();
			$sql->table('TABLE_DOWNLOADS');
			$id = (int) $id;
			$where = array(
				'name' => 'id',
				'value' => $id
			);
			$sql->where($where);
			$sql->queryOne();
			$return = $sql->data;

			$sqlCat = New BDD();
			$sqlCat->table('TABLE_DOWNLOADS_CAT');
			$idCatwhere = array(
				'name' => 'id',
				'value' => $return->idcat
			);
			$sqlCat->where($idCatwhere);
			$sqlCat->queryOne();
			$returnCat = $sqlCat->data;

		}
		if (Secures::isAcess($returnCat->groups) == true) {
			return true;
		} else {
			return false;
		}
	}

	public function getDownloads ($id = null)
	{
		if ($id !== null && is_numeric($id)) {
			$sql = New BDD();
			$sql->table('TABLE_DOWNLOADS');
			$id = (int) $id;
			$where = array(
				'name' => 'id',
				'value' => $id
			);
			$sql->where($where);
			$sql->queryOne();
			$return = $sql->data;

			self::AddDownload($id);

			return $return->download;
		}
	}

	public function NewView ($id = false)
	{
		if ($id) {
			$id  = Common::secureRequest($id);
			$get = New BDD();
			$get->table('TABLE_DOWNLOADS');
			$where = array(
				'name'  => 'id',
				'value' => (int) $id
			);
			$get->where($where);
			$get->queryOne();
			$data = $get->data;
			if ($get->rowCount != 0) {
				$count = (int) $data->view;
				$count++;
				$update = New BDD();
				$update->table('TABLE_DOWNLOADS');
				$update->where($where);
				$update->sqlData(array('view' => $count));
				$update->update();
			}
		}
	}

	public function AddDownload ($id = false)
	{
		if ($id) {
			$id  = Common::secureRequest($id);
			$get = New BDD();
			$get->table('TABLE_DOWNLOADS');
			$where = array(
				'name'  => 'id',
				'value' => (int) $id
			);
			$get->where($where);
			$get->queryOne();
			$data = $get->data;
			if ($get->rowCount != 0) {
				$count = (int) $data->dls;
				$count++;
				$update = New BDD();
				$update->table('TABLE_DOWNLOADS');
				$update->where($where);
				$update->sqlData(array('dls' => $count));
				$update->update();
			}
		}
	}

	public function countFiles ($id)
	{
			$id  = Common::secureRequest($id);
			$get = New BDD();
			$get->table('TABLE_DOWNLOADS');
			$where = array(
				'name'  => 'idcat',
				'value' => (int) $id
			);
			$get->where($where);
			$get->queryAll();
			if ($get->rowCount != 0) {
				return (int) $get->rowCount;
			} else {
				return (int) 0;
			}
	}
}
