<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.3
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

include DIR_PAGES.'shoutbox'.DS.'models.php';

class ModelsManagementShoutobx extends ModelsShoutbox
{
	protected function sendEditMsg ($id, $msg)
	{
		$where = array(
			'name'  => 'id',
			'value' => (int) $id
		);

		$msg = Common::VarSecure($msg);

		$sql = New BDD();
		$sql->table('TABLE_SHOUTBOX');
		$sql->sqldata(array('msg' => $msg));
		$sql->where($where);
		$sql->update();

		$return['text']	= 'Message éditer avec succès';
		$return['type']	= 'success';

		return $return;
	}

	protected function DelMsg ($data = false)
	{
		if ($data !== false) {
			// SECURE DATA
			$delete = (int) $data;
			// SQL DELETE
			$sql = New BDD();
			$sql->table('TABLE_SHOUTBOX');
			$sql->where(array('name'=>'id','value' => $delete));
			$sql->delete();
			// SQL RETURN NB DELETE
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => DEL_SHOUTBOX_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'alert',
					'text' => DEL_SHOUTBOX_ERROR
				);
			}
		} else {
			$return = array(
				'type' => 'alert',
				'text' => ERROR_NO_DATA
			);
		}
		return $return;
	}
}
