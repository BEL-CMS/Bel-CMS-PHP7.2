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

class ModelsGallery
{
	#####################################
	# Infos tables
	#####################################
	# TABLE_GALLERY
	# TABLE_GALLERY_CAT
	#####################################
	public function GetImg ()
	{
		$sql = New BDD();
		$sql->table('TABLE_GALLERY');
		$sql->queryAll();
		return $sql->data;
	}

	public function GetNameCat ($id = null)
	{
		$sql = New BDD();
		$sql->table('TABLE_GALLERY_CAT');

		if ($id !== null && is_numeric($id)) {
			$id = (int) $id;
			$where = array(
				'name' => 'cat',
				'value' => $id
			);
			$sql->where($where);
			if (!empty($this->data)){
				
			}
		}
	}
}