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

class ModelsCode
{
	public function get($search = null)
	{
		$return = array();

		$sql = New BDD;
		$sql->table('TABLE_CODE');
		if ($search !== null) {
			$sql->where(array(
				'name'  => 'name',
				'value' => $search
			));
		}
		$sql->queryAll();

		if ($sql->data) {
			$return = $sql->data;
		}

		return $return;
	}
	public function insert($data)
	{
		if (!empty($data) && is_array($data)) {
			// SECURE DATA
			$insert['name']        = Common::VarSecure($data['name'], '');
			$insert['cat']         = Common::VarSecure($data['cat'], '');
			$insert['tags']        = Common::VarSecure($data['tags'], '');
			$insert['code']        = '<pre class="pre" data-enlighter-language="'.$data['cat'].'">'.htmlentities($data['code']).'</pre>';
			$insert['court']       = Common::VarSecure($data['court'], '');
			$insert['description'] = $data['description'];
			$insert['author']      = $_SESSION['USER']['HASH_KEY'];
			// SQL INSERT
			$sql = New BDD();
			$sql->table('TABLE_CODE');
			$sql->sqlData($insert);
			$sql->insert();
			// SQL RETURN NB INSERT
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => SEND_CODE_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => SEND_CODE_ERROR
				);
			}
		} else {
			$return = array(
				'type' => 'warning',
				'text' => ERROR_NO_DATA
			);
		}
		return $return;
	}
}
