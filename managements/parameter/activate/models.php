<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class ModelsActivate
{
	#####################################
	# Infos tables
	#####################################
	# TABLE_PAGES_CONFIG
	# TABLE_WIDGETS
	#####################################
	# récupère les pages
	#####################################
	public function getNamePages ()
	{
		$sql = New BDD;
		$sql->table('TABLE_PAGES_CONFIG');
		$sql->orderby(array(array('name' => 'name', 'type' => 'DESC')));
		$sql->queryAll();
		if (!empty($sql->data)) {
			return $sql->data;
		} else {
			return (object) array();
		}
	}
	#####################################
	# récupère les widgets
	#####################################
	public function getNameWidgets ()
	{
		$sql = New BDD;
		$sql->table('TABLE_WIDGETS');
		$sql->orderby(array(array('name' => 'name', 'type' => 'DESC')));
		$sql->queryAll();
		if (!empty($sql->data)) {
			return $sql->data;
		} else {
			return (object) array();
		}
	}
	#####################################
	# Envoie le formulaire pages en BDD
	#####################################
	public function sendBDDPages ($data)
	{
		foreach (self::getNamePages () as $k => $v) {
			if (array_key_exists($v->name, $data)) {
				$sql = New BDD;
				$sql->table('TABLE_PAGES_CONFIG');
				$sql->where(array('name'=> 'name','value'=> $v->name));
				$sql->sqlData(array('active' => 1));
				$sql->update();
				unset($sql);
			} else {
				$sql = New BDD;
				$sql->table('TABLE_PAGES_CONFIG');
				$sql->where(array('name'=> 'name','value'=> $v->name));
				$sql->sqlData(array('active' => 0));
				$sql->update();
				unset($sql);
			}
		}
		$save = array(
			'type' => 'success',
			'msg'  => SAVE_BDD_SUCCESS
		);
		return $save;
	}
	#####################################
	# Envoie le formulaire Widgets en BDD
	#####################################
	public function sendBDDWidgets ($data)
	{
		foreach (self::getNamePages () as $k => $v) {
			if (array_key_exists($v->name, $data)) {
				$sql = New BDD;
				$sql->table('TABLE_WIDGETS');
				$sql->where(array('name'=> 'name','value'=> $v->name));
				$sql->sqlData(array('active' => 1));
				$sql->update();
				unset($sql);
			} else {
				$sql = New BDD;
				$sql->table('TABLE_WIDGETS');
				$sql->where(array('name'=> 'name','value'=> $v->name));
				$sql->sqlData(array('active' => 0));
				$sql->update();
				unset($sql);
			}
		}
		$save = array(
			'type' => 'success',
			'msg'  => SAVE_BDD_SUCCESS
		);
		return $save;
	}
}