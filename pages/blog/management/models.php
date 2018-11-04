<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.3.0
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
	public function GetBlog ($id = false)
	{
		if (isset($_SESSION['pages']->blog->config['MAX_BLOG_ADMIN'])) {
			$nbpp = (int) $_SESSION['pages']->blog->config['MAX_BLOG_ADMIN'];
		} else {
			$nbpp = (int) 25;
		}

		$page = (Dispatcher::RequestPages() * $nbpp) - $nbpp;

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
				if (empty($author)) {
					$sql->data->author =  (object) array(
						'hash_key' => null,
						'username' => DELETE,
						'avatar'   => DEFAULT_AVATAR,
						'groups'   => array()
					);
				} else {
					$sql->data->author = AutoUser::getInfosUser($author);
					if (!isset($sql->data->author->hash_key)) {
						$sql->data->author->hash_key = null;
					}
				}
			}
		} else {
			$sql->orderby(array(array('name' => 'id', 'type' => 'DESC')));
			//$sql->limit(array(0 => $page, 1 => $nbpp), true);
			$sql->queryAll();
			foreach ($sql->data as $k => $v) {
				$sql->data[$k]->link = 'blog/readmore/'.$v->rewrite_name.'/'.$v->id;
				if (empty($sql->data[$k]->tags)) {
					$sql->data[$k]->tags = array();
				} else {
					$sql->data[$k]->tags = explode(',', $sql->data[$k]->tags);
				}
				$author = $sql->data[$k]->author;
				if (empty($author)) {
					$sql->data[$k]->author =  (object) array(
						'hash_key' => null,
						'username' => DELETE,
						'avatar'   => DEFAULT_AVATAR,
						'groups'   => array()
					);
				} else {
					$sql->data[$k]->author = AutoUser::getInfosUser($author);
				}
			}
		}
		return $sql->data;
	}

	public function SendNew ($data = false)
	{
		if ($data !== false) {
			// SECURE DATA
			$insert['rewrite_name']      = Common::MakeConstant($data['name']);
			$insert['name']              = Common::VarSecure($data['name'], ''); // autorise que du texte
			$insert['content']           = Common::VarSecure($data['content'], 'html'); // autorise que les balises HTML
			$insert['additionalcontent'] = Common::VarSecure($data['additionalcontent'], 'html'); // autorise que les balises HTML
			$user                        = Autouser::ReturnUser();
			$insert['author']            = $user->hash_key;
			$insert['tags']              = Common::VarSecure($data['tags'], ''); // autorise que du texte
			$insert['cat']               = ''; // à implanter
			// SQL INSERT
			$sql = New BDD();
			$sql->table('TABLE_PAGES_BLOG');
			$sql->sqlData($insert);
			$sql->insert();
			// SQL RETURN NB INSERT
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => NEW_BLOG_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'alert',
					'text' => NEW_BLOG_ERROR
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

	public function SendEdit ($data = false)
	{
		if ($data !== false) {
			// SECURE DATA
			$edit['rewrite_name']      = Common::MakeConstant($data['name']);
			$edit['name']              = Common::VarSecure($data['name'], ''); // autorise que du texte
			$edit['content']           = Common::VarSecure($data['content'], 'html'); // autorise que les balises HTML
			$edit['additionalcontent'] = Common::VarSecure($data['additionalcontent'], 'html'); // autorise que les balises HTML
			$edit['author']            = strlen($data['author']) == 32 ? $data['author'] : null;
			$edit['authoredit']        = strlen($data['authoredit']) == 32 ? $data['authoredit'] : null;
			$edit['tags']              = Common::VarSecure($data['tags'], ''); // autorise que du texte
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
					'type' => 'alert',
					'text' => EDIT_BLOG_ERROR
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

	public function UpdateParameter ($data = false)
	{
		if ($data !== false) {
			// SECURE DATA
			unset($data['send']);
			$update['config'] = Common::transformOpt($data, true);
			// SQL UPDATE
			$sql = New BDD();
			$sql->table('TABLE_PAGES_CONFIG');
			$sql->where(array('name'=>'name','value' => 'blog'));
			$sql->sqlData($update);
			$sql->update();
			// SQL RETURN NB UPDATE
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => NEW_PARAMETER_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'alert',
					'text' => NEW_PARAMETER_ERROR
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

	public function DelNew ($data = false)
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
					'type' => 'alert',
					'text' => DEL_BLOG_ERROR
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
