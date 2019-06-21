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

	public function getBlog ($id = false)
	{
		$sql = New BDD();
		$sql->table('TABLE_PAGES_BLOG');

		if ($id) {
			$request = Common::secureRequest($id);
			if (is_numeric($id)) {
				$sql->where(array(
					'name'  => 'id',
					'value' => $request
				));
			} else {
				$sql->where(array(
					'name'  => 'rewrite_name',
					'value' => $request
				));
			}
			$sql->queryOne();
			if (!empty($sql->data)) {
				$sql->data->link = 'blog/readmore/'.$sql->data->rewrite_name.'?id='.$sql->data->id;
				if (empty($sql->data->tags)) {
					$sql->data->tags = array();
				} else {
					$sql->data->tags = explode(',', $sql->data->tags);
				}
				$author = $sql->data->author;
				$sql->data->username = Users::hashkeyToUsernameAvatar($author);
				$sql->data->avatar   = Users::hashkeyToUsernameAvatar($author, 'avatar');
			} else {
				$sql->data = null;
			}
		}
		return $sql->data;
	}

	public function sendEdit ($data = false)
	{
		if ($data !== false) {
			// SECURE DATA
			$edit['rewrite_name']      = Common::MakeConstant($data['name']);
			$edit['name']              = Common::VarSecure($data['name'], ''); // autorise que du texte
			$edit['content']           = Common::VarSecure($data['content'], 'html'); // autorise que les balises HTML
			$edit['additionalcontent'] = Common::VarSecure($data['additionalcontent'], 'html'); // autorise que les balises HTML
			$edit['author']            = strlen($data['author']) == 32 ? $data['author'] : $_SESSION['USER']['HASH_KEY'];
			$edit['authoredit']        = $_SESSION['USER']['HASH_KEY'];
			$edit['tags']              = Common::VarSecure($data['tags'], ''); // autorise que du texte
			$edit['tags']              = str_replace(' ', '', $edit['tags']);
			$edit['cat']               = ''; // à implanter
			// SQL UPDATE
			$sql = New BDD();
			$sql->table('TABLE_PAGES_BLOG');
			$id = Common::SecureRequest($data['id']);
			$sql->where(array('name' => 'id', 'value' => $id));
			$sql->sqlData($edit);
			$sql->update();
			// SQL RETURN NB UPDATE
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => EDIT_BLOG_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => EDIT_BLOG_ERROR
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

	public function getNbBlog ()
	{
		$return = 0;

		$sql = New BDD();
		$sql->table('TABLE_PAGES_BLOG');
		$sql->count();

		if (!empty($sql->data)) {
			$return = $sql->data;
		}

		return $return;
	}

	public function sendparameter($data = null)
	{
		if ($data !== false) {
			$data['MAX_BLOG'] = (int) $data['MAX_BLOG'];
			$opt = array('MAX_BLOG' => $data['MAX_BLOG']);
			$upd['config'] = Common::transformOpt($opt, true);
			// SQL UPDATE
			$sql = New BDD();
			$sql->table('TABLE_PAGES_CONFIG');
			$sql->where(array('name' => 'name', 'value' => 'blog'));
			$sql->sqlData($upd);
			$sql->update();
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => EDIT_BLOG_PARAM_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => EDIT_BLOG_PARAM_ERROR
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