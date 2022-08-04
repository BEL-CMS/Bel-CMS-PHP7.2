<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2022 Bel-CMS
 * @author Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

final class ModelsColor
{
	#####################################
	# Infos tables
	#####################################
	# TABLE_CONFIG
	#####################################
	public function editColor ($data = null)
	{
		if ($data != null) {
			foreach ($data as $k => $v) {
				$sql = New BDD();
				$sql->table('TABLE_CONFIG');
				$sql->where(array('name'=>'name','value'=>$k));
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
	}
}