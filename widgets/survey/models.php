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
#	TABLE_SURVEY
#->	id, number, content, vote
#	TABLE_SURVEY_QUEST
#->	id, name, date
#	TABLE_SURVEY_AUTHOR
#->	id, idvote, author, date
class ModelsSurvey
{
	public function getLastSurvey ()
	{
		$return = null;

		$sql = New BDD();
		$sql->table('TABLE_SURVEY_QUEST');
		$sql->orderby(array(array('name' => 'id', 'type' => 'DESC')));
		$sql->queryOne();
		if (!empty($sql->data)) {
			$return = $sql->data;
		}

		return $return;
	}

	public function getNumberVote ($id = null)
	{
		$return = array();

		if ($id != null) {
			$sql = New BDD();
			$sql->table('TABLE_SURVEY');
			$sql->orderby(array(array('name' => 'id', 'type' => 'ASC')));
			$where = array('name' => 'idvote', 'value' => $id);
			$sql->where($where);
			$sql->queryAll();
			if (!empty($sql->data)) {
				$return = $sql->data;
			}	
		}

		return $return;
	}

	public function countVote ($id = null)
	{
		if ($id != null && is_numeric($id)) {
			$sql = New BDD();
			$sql->table('TABLE_SURVEY_AUTHOR');
			$where[] = array('name'=>'idvote','value'=>$id);
			$where[] = array('name'=>'author','value'=>$_SESSION['USER']['HASH_KEY']);
			$sql->where($where);
			$sql->count();
			$returnCheckName = (int) $sql->data;
			if ($returnCheckName >= 1) {
				return false;
			} else {
				return true;
			}
		}
	}
}