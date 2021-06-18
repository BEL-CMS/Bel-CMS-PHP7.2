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
		$insert['name'] = Common::VarSecure($data['name']);
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

	public function editSurvey ($id)
	{
		$return = array();

		$sql = New BDD();
		$sql->table('TABLE_SURVEY');
		$sql->where(array('name'=> 'idvote', 'value' => $id));
		$sql->queryAll();
		if (!empty($sql->data)) {
			$return = $sql->data;
		}

		return $return;
	}

	public function sendedit($data)
	{
		if (!empty($data) && is_array($data)) {
			$upd1['name']    = $data['name'];
			$update1 = New BDD;
			$update1->table('TABLE_SURVEY_QUEST');
			$where   = array('name' => 'id', 'value' => $data['id']);
			$update1->where($where);
			$update1->sqlData($upd1);
			$update1->update();

			$del = New BDD;
			$del->table('TABLE_SURVEY');
			$delWhere   = array('name' => 'idvote', 'value' => $data['id']);
			$del->where($delWhere);
			$del->delete();

			foreach ($data['quest'] as $k => $v) {
				$insert2['content'] = $v;
				$insert2['idvote']  = $data['id'];
				$insert2['number']  = md5(uniqid(rand(), true));
				if (!empty($v)) {
					$sql = New BDD;
					$sql->table('TABLE_SURVEY');
					$sql->sqlData($insert2);
					$sql->insert();
				}
			}

			if ($update1->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => EDIT_SURVEY_PARAM_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => EDIT_SURVEY_PARAM_ERROR
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

	public function surveyQuest ($id)
	{
		$select = New BDD;
		$select->table('TABLE_SURVEY_QUEST');
		$where = array('name' => 'id', 'value' => $id);
		$select->where($where);
		$select->queryOne();
		$return = $select->data;
		return $return;
	}

	public function sendparameter ($data)
	{
		$return = array();

		if (!empty($data) && is_array($data)) {
			if (!isset($data['JS'])) {
				$data['JS'] = 0;
			}
			if (!isset($data['CSS'])) {
				$data['CSS'] = 0;
			}
			$opt                  = array('JS' => $data['JS'], 'CSS' => $data['CSS']);
			$upd['config']        = Common::transformOpt($opt, true);
			$upd['title']         = Common::VarSecure($data['title'], '');
			$upd['groups_access'] = implode("|", $data['groups']);
			$upd['groups_admin']  = implode("|", $data['admin']);
			$upd['active']        = isset($data['active']) ? 1 : 0;
			if ($data['pos'] == 'top') {
				$upd['pos'] = 'top';
			} else if ($data['pos'] == 'bottom') {
				$upd['pos'] = 'bottom';
			} else if ($data['pos'] == 'left') {
				$upd['pos'] = 'left';
			} else if ($data['pos'] == 'right') {
				$upd['pos'] = 'right';
			} else {
				$upd['pos'] = 'right';
			}
			$upd['pages']  = implode("|", $data['pages']);
			// SQL UPDATE
			$sql = New BDD();
			$sql->table('TABLE_WIDGETS');
			$sql->where(array('name' => 'name', 'value' => 'survey'));
			$sql->sqlData($upd);
			$sql->update();
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => EDIT_SURVEY_PARAM_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => EDIT_SURVEY_PARAM_ERROR
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

	public function delete ($data = false)
	{
		if ($data !== false) {
			// SECURE DATA
			$delete = (int) $data;
			// SQL DELETE
			$sql = New BDD();
			$sql->table('TABLE_SURVEY_QUEST');
			$sql->where(array('name'=>'id','value' => $delete));
			$sql->delete();

			$sql2 = New BDD();
			$sql2->table('TABLE_SURVEY');
			$sql2->where(array('name'=>'idvote','value' => $delete));
			$sql2->delete();	

			$sql3 = New BDD();
			$sql3->table('TABLE_SURVEY_AUTHOR');
			$sql3->where(array('name'=>'idvote','value' => $delete));
			$sql3->delete();	
			// SQL RETURN NB DELETE
			$return = array(
				'type' => 'success',
				'text' => 'DEL_VOTE_SUCCES'
			);
		} else {
			$return = array(
				'type' => 'error',
				'text' => ERROR_NO_DATA
			);
		}
		return $return;
	}
}