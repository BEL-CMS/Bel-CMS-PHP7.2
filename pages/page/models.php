<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class ModelsPage
{
	public function getPage ()
	{
		$sql = New BDD;
		$sql->table('TABLE_PAGE');
		$sql->queryAll();
		foreach ($sql->data as $k => $v) {
			$get = New BDD();
			$get->table('TABLE_PAGE_CONTENT');
			$where = array(
				'name'  => 'number',
				'value' => $v->id
			);
			$get->where($where);
			$get->count();
			$return = $get->data;
			$sql->data[$k]->count = $return;
		}

		return $sql->data;
	}

	public function getPageId ($id = false)
	{
		$sql = New BDD;
		$sql->table('TABLE_PAGE');
		$where = array(
			'name'  => 'id',
			'value' => $id
		);
		$sql->where($where);
		$sql->queryOne();

		return $sql->data;
	}

	public function getPages ($id = null)
	{
		$return = array();

		if (is_numeric($id)) {
			$sql = New BDD;
			$sql->table('TABLE_PAGE_CONTENT');
			$where = array(
				'name'  => 'number',
				'value' => $id
			);
			$sql->where($where);
			$sql->queryAll();

			$return = $sql->data;
		}

		return $return;
	}

	public function getPageContentId ($id = null)
	{
		$return = array();

		if (is_numeric($id)) {
			$sql = New BDD;
			$sql->table('TABLE_PAGE_CONTENT');
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

	public function  testExistPage ($name = false) {
		$sql = New BDD();
		$sql->table('TABLE_PAGE');
		$where = array(
			'name'  => 'name',
			'value' => Common::MakeConstant($name)
		);
		$sql->fields(array('id'));
		$sql->where($where);
		$sql->queryOne();

		$count  = $sql->rowCount;

		if ($count == 1) {
			$return = true;
		} else {
			$return = false;
		}

		return $return;
	}
}
