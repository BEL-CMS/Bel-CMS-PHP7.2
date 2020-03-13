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
	public function getAllSurvey ()
	{
		$return = array();

		$sql = New BDD();
		$sql->table('TABLE_SURVEY_QUEST');
		$sql->orderby(array(array('name' => 'id', 'type' => 'DESC')));
		$sql->queryAll();
		if (!empty($sql->data)) {
			$return = $sql->data;
		}

		return $return;
	}

	public function send ($data)
	{
		$insert['name'] = Common::VarSecure($_POST['name'], '');
		$insert['date'] = date('Y-m-d H:i:s');

		$sql1 = New BDD;
		$sql1->table('TABLE_SURVEY_QUEST');
		$sql1->sqlData($insert);
		$sql1->insert();

		$select = New BDD;
		$select->table('TABLE_SURVEY_QUEST');
		$where = array('name' => 'date', 'value' => $insert['date']);
		$select->where($where);
		$select->queryOne();
		$return = $select->data;

		$insert2['idvote'] = $return->id;

		foreach ($data['quest'] as $k => $v) {
			$insert2['content'] = $v;
			$insert2['number']  = md5(uniqid(rand(), true));
			if (!empty($v)) {
				$sql = New BDD;
				$sql->table('TABLE_SURVEY');
				$sql->sqlData($insert2);
				$sql->insert();
			}
		}
		$return = array(
			'type' => 'success',
			'text' => ADD_SONDAGE_SUCCESS
		);

		return $return;

	}
}