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

class ModelsCode
{
	public function getSearch($data = null)
	{
		$return = null;
		if ($data !== null && is_array($data))
		{
			$sql = New BDD();
			$sql->table('TABLE_CODE');
			if ($data['type'] == 'php') {
				$type = 'php';
			} else if ($data['type'] == 'html') {
				$type = 'php';
			} else if ($data['type'] == 'css') {
				$type = 'css';
			} else if ($data['type'] == 'js') {
				$type = 'js';
			} else {
				return false;
			}
			$data['text'] = Common::removeBlank($data['text']);
			$where = Common::VarSecure($data['text']);
			$sql->where('WHERE 1 AND cat = "'.$type.'" AND `description` LIKE "%%'.$where.'%%"');
			$sql->queryAll();
			return $sql->data;
		}
	}

	public function getPage ($id)
	{
		$retun = null;
		if (is_numeric($id)) {
			$sql = New BDD();
			$sql->table('TABLE_CODE');
			$where = array('name' => 'id', 'value' => $id);
			$sql->where($where);
			$sql->queryOne();
			if (!empty($sql->data)) {
				$return = $sql->data;
			}
		}
		return $return;
	}

	public function getPhp()
	{
		$nbpp = (int) 25;
		$page = (Dispatcher::RequestPages() * $nbpp) - $nbpp;
		$sql = New BDD();
		$sql->table('TABLE_CODE');
		$where = array('name' => 'cat', 'value' => 'php');
		$sql->where($where);
		$sql->orderby(array(array('name' => 'id', 'type' => 'DESC')));
		$sql->limit(array(0 => $page, 1 => $nbpp), true);
		$sql->queryAll();
		return $sql->data;
	}

	public function getHtml()
	{
		$nbpp = (int) 25;
		$page = (Dispatcher::RequestPages() * $nbpp) - $nbpp;
		$sql = New BDD();
		$sql->table('TABLE_CODE');
		$where = array('name' => 'cat', 'value' => 'html');
		$sql->where($where);
		$sql->orderby(array(array('name' => 'id', 'type' => 'DESC')));
		$sql->limit(array(0 => $page, 1 => $nbpp), true);
		$sql->queryAll();
		return $sql->data;
	}

	public function getCss()
	{
		$nbpp = (int) 25;
		$page = (Dispatcher::RequestPages() * $nbpp) - $nbpp;
		$sql = New BDD();
		$sql->table('TABLE_CODE');
		$where = array('name' => 'cat', 'value' => 'css');
		$sql->where($where);
		$sql->orderby(array(array('name' => 'id', 'type' => 'DESC')));
		$sql->limit(array(0 => $page, 1 => $nbpp), true);
		$sql->queryAll();
		return $sql->data;
	}

	public function getJs()
	{
		$nbpp = (int) 25;
		$page = (Dispatcher::RequestPages() * $nbpp) - $nbpp;
		$sql = New BDD();
		$sql->table('TABLE_CODE');
		$where = array('name' => 'cat', 'value' => 'js');
		$sql->where($where);
		$sql->orderby(array(array('name' => 'id', 'type' => 'DESC')));
		$sql->limit(array(0 => $page, 1 => $nbpp), true);
		$sql->queryAll();
		return $sql->data;
	}
}