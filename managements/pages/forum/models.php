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

class ModelsForum
{
	public function GetThreads($id = null)
	{
		$sql = New BDD();
		$sql->table('TABLE_FORUM_THREADS');
		if ($id === null) {
			$sql->orderby(array(array('name' => 'id_forum', 'type' => 'ASC')));
			$sql->queryAll();
			$return = $sql->data;
			foreach ($return as $k => $v) {
				$return[$k]->id_forum = self::GetForum($v->id_forum);
			}
		} else {
			$tmp_where[] = array(
				'name'  => 'id',
				'value' => (int) $id
			);
			$sql->where($tmp_where);
			$sql->queryOne();
			$return = $sql->data;
			$return->id_forum = self::GetForum($return->id_forum);
		}
		return $return;
	}

	public function GetForum ($id = null)
	{
		$sql = New BDD();
		$sql->table('TABLE_FORUM');
		if ($id === null) {
			$sql->orderby(array(array('name' => 'title', 'type' => 'ASC')));
			$sql->queryAll();
		} else {
			$tmp_where[] = array(
				'name'  => 'id',
				'value' => (int) $id
			);
			$sql->where($tmp_where);
			$sql->queryOne();
			$sql->data->groups = explode('|', $sql->data->groups);
		}
		$return = $sql->data;
		return $return;
	}

	public function isCat ()
	{
		$sql = New BDD();
		$sql->table('TABLE_FORUM');
		$sql->count();
		if ($sql->data <= 1) {
			$return = true;
		} else {
			$return = false;
		}
		return $return;
	}
}