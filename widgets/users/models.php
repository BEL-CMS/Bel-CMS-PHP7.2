<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
 * @link https://bel-cms.be
 * @link https://stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2019 Bel-CMS
 * @author Stive - determe@stive.eu
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class ModelsUsers extends Widgets
{
	public function getInfosUser ()
	{
		$return = null;

		if (Users::isLogged()) {

			$sql = New BDD;
			$sql->table('TABLE_USERS');
			$sql->where(array('name' => 'hash_key', 'value' => $_SESSION['USER']['HASH_KEY']));
			$sql->queryOne();

			if ($sql->data) {
				$return = $sql->data;
			}
		}

		return $return;
	}
}