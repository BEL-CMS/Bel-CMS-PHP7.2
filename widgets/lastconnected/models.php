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

class ModelsLastConnectedUsers
{
	public function getUsers($limit = 5)
	{
		$return = null;

		$this->sql = New BDD();
		$this->sql->table('TABLE_USERS');
		$this->sql->orderby(array(array('name' => 'last_visit', 'type' => 'DESC')));
		$this->sql->fields(array('username', 'avatar', 'last_visit'));
		$this->sql->limit($limit);
		$this->sql->queryAll();
		if (!empty($this->sql->data)) {
			$return = $this->sql->data;
			foreach ($return as $k => $v) {
				$return[$k]->avatar = is_file($v->avatar) ? $v->avatar : 'assets/images/default_avatar.jpg';
			}
		}
		return $return;

	}
}
