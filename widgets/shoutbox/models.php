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

class ModelsShoutbox
{
	public function getMsg()
	{
		$nbpp = 10;

		$this->sql = New BDD();
		$this->sql->table('TABLE_SHOUTBOX');
		$this->sql->orderby(array(array('name' => 'id', 'type' => 'DESC')));
		$this->sql->limit($nbpp);
		$this->sql->queryAll();
		if (!empty($this->sql->data)) {
			$return = $this->sql->data;
		} else {
			$return = array();
		}
		return $return;
	}

	public function getsmiley ()
	{
		$sql = New BDD();
		$sql->table('TABLE_EMOTICONES');
		$sql->queryAll();
		return $sql->data;
	}
}
