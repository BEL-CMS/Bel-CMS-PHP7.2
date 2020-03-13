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

class ModelsBlog
{
	#####################################
	# Infos tables
	#####################################
	# TABLE_PAGES_BLOG
	#####################################
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
			if (empty($data['name'])) {
				$return = array(
					'type' => 'error',
					'text' => ADD_BLOG_EMPTY
				);
				return $return;
			}
			if (empty($data['content'])) {
				$return = array(
					'type' => 'error',
					'text' => ADD_BLOG_EMPTY_CONTENT
				);
				return $return;
			}
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

	public function sendnew ($data = false)
	{
		if (empty($data['name'])) {
			$return = array(
				'type' => 'error',
				'text' => ADD_BLOG_EMPTY
			);
			return $return;
		}
		if (empty($data['content'])) {
			$return = array(
				'type' => 'error',
				'text' => ADD_BLOG_EMPTY_CONTENT
			);
			return $return;
		}
		if ($data !== false) {
			// SECURE DATA
			$send['rewrite_name']      = Common::MakeConstant($data['name']);
			$send['name']              = Common::VarSecure($data['name'], ''); // autorise que du texte
			$send['content']           = Common::VarSecure($data['content'], 'html'); // autorise que les balises HTML
			$send['additionalcontent'] = Common::VarSecure($data['additionalcontent'], 'html'); // autorise que les balises HTML
			$send['author']            = $_SESSION['USER']['HASH_KEY'];
			$send['authoredit']        = null;
			$send['tags']              = Common::VarSecure($data['tags'], ''); // autorise que du texte
			$send['tags']              = str_replace(' ', '', $send['tags']);
			$send['cat']               = ''; // à implanter
			$send['view']              = 0;
			// SQL INSERT
			$sql = New BDD();
			$sql->table('TABLE_PAGES_BLOG');
			$sql->sqlData($send);
			$sql->insert();
			// SQL RETURN NB INSERT
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => SEND_BLOG_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => SEND_BLOG_ERROR
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
			$data['admin']        = isset($data['admin']) ? $data['admin'] : array(1);
			$data['groups']       = isset($data['groups']) ? $data['groups'] : array(1);
			$upd['config']        = Common::transformOpt($opt, true);
			$upd['active']        = isset($data['active']) ? 1 : 0;
			$upd['access_admin']  = implode("|", $data['admin']);
			$upd['access_groups'] = implode("|", $data['groups']);
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

	public function delete ($data = false)
	{
		if ($data !== false) {
			// SECURE DATA
			$delete = (int) $data;
			// SQL DELETE
			$sql = New BDD();
			$sql->table('TABLE_PAGES_BLOG');
			$sql->where(array('name'=>'id','value' => $delete));
			$sql->delete();
			// SQL RETURN NB DELETE
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => DEL_BLOG_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => DEL_BLOG_ERROR
				);
			}
		} else {
			$return = array(
				'type' => 'error',
				'text' => ERROR_NO_DATA
			);
		}
		return $return;
	}
}