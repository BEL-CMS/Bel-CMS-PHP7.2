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

final class ModelsThemes
{
	public function getTpl ()
	{
		$return = Common::ScanDirectory(DIR_TPL);
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

	public function getTplImg ()
	{
		$scan = Common::ScanDirectory(DIR_TPL);

		if (count($scan) !== 0):
			foreach ($scan as $k => $n):
				if (is_file('templates'.DS.$n.DS.'screen.png')):
					$return[$n] = 'templates'.DS.$n.DS.'screen.png';
				else:
					$return[$n] = 'templates'.DS.'noscreen.png';
				endif;
			endforeach;
		endif;

		return $return;		
	}

	public function getInfos ($n = null)
	{
		$file = DIR_TPL.$n.DS.'infos.php';
		if (is_file($file)):
			require_once $file;
			return $description;
		endif;
	}

	public function sendTpl ($data)
	{
		$sql = New BDD;
		$sql->table('TABLE_CONFIG');
		$sql->where(array('name'=>'name','value'=>'CMS_TPL_WEBSITE'));
		$sql->sqlData(array('value' => $data));
		$sql->update();
		$return = array('type' => 'success', 'text' => 'le Theme principale a été changé', 'title' => 'Templates');
		return $return;
	}

	public function sendPages ()
	{
		$data = implode(',', $_POST['full']);
		$sql = New BDD;
		$sql->table('TABLE_CONFIG');
		$sql->where(array('name'=>'name','value'=>'CMS_TPL_FULL'));
		$sql->sqlData(array('value' => $data));
		$sql->update();
		$return = array('type' => 'success', 'text' => 'les templates en full ont été changer', 'title' => 'Templates');
		return $return;
	}

	public function listPages ()
	{
		$return = Common::ScanDirectory(DIR_PAGES);
		return $return;
	}

	public function searchPages ()
	{
		$sql = New BDD;
		$sql->table('TABLE_CONFIG');
		$sql->where(array('name'=>'name','value'=>'CMS_TPL_FULL'));
		$sql->queryOne();
		$data = $sql->data;
		$return = explode(',', $data->value);
		return $return;
	}
}