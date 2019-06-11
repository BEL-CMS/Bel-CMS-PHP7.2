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

class ModelsBlog
{
	public function getAllBlog ()
	{
		$return = array();

		$sql = New BDD;
		$sql->table('TABLE_PAGES_BLOG');
		$sql->queryAll();

		if ($sql->data) {
			$return = $sql->data;
		}

		return $return;
	}
}