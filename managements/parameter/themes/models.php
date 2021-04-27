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

final class ModelsThemes
{
	public function getTpl ()
	{
		$return = Common::ScanDirectory(DIR_TPL);

		if (count($return) !== 0) {
			foreach ($return as $k => $n) {
				if (!is_file(DIR_TPL.$n.DS.'template.php')) {
					unset($return[$k]);
				}
			}
		}

		return $return;
	}

	public function getTplActive ()
	{
		$sql = New BDD();
		$sql->table('TABLE_CONFIG');
		$sql->where(array('name'=>'name','value'=>'CMS_TPL_WEBSITE'));
		$sql->queryOne();
		$return = $sql->data;
		return $return;
	}

	public function sendTpl ($data)
	{
		$sql = New BDD;
		$sql->table('TABLE_CONFIG');
		$sql->where(array('name'=>'name','value'=>'CMS_TPL_WEBSITE'));
		$sql->sqlData(array('value' => $data['tpl']));
		$sql->update();
		$return = array('type' => 'success', 'text' => 'le Theme principale a été changé', 'title' => 'Templates');
		return $return;
	}
}