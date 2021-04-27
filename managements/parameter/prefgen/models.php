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

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class ModelsPrefGen
{
	public function send ($data = false)
	{
		foreach ($data as $k => $v) {
			$sql = New BDD();
			$sql->table('TABLE_CONFIG');
			$sql->where(array('name'=>'id','value'=>$k));
			$sql->sqlData(array('value' => $v));
			$sql->update();
			unset($sql);
		}

		$save = array(
			'type' => 'success',
			'text' => SAVE_BDD_SUCCESS
		);

		return $save;
	}
	public function getData ()
	{
		$sql = New BDD();
		$sql->table('TABLE_CONFIG');
		$sql->orderby(array(array('name' => 'name', 'type' => 'DESC')));
		$sql->queryAll();
		$return = $sql->data;

		return $return;
	}
}
