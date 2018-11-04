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
		if (isset($_SESSION['pages']->blog->config['MAX_BLOG'])) {
			$nbpp = (int) $_SESSION['pages']->blog->config['MAX_BLOG'];
		} else {
			$nbpp = (int) 3;
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
						'username' => DELETE,
						'avatar'   => DEFAULT_AVATAR,
						'groups'   => array()
					);
				} else {
					$sql->data->author = AutoUser::getInfosUser($author);
				}
			}
		} else {
			$sql->orderby(array(array('name' => 'id', 'type' => 'DESC')));
			$sql->limit(array(0 => $page, 1 => $nbpp), true);
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

	public function GetLastBlog ()
	{
		$return = false;

		$sql = New BDD();
		$sql->table('TABLE_PAGES_BLOG');
		$sql->orderby(array(array('name' => 'id', 'type' => 'DESC')));
		$sql->limit('1');
		$sql->queryOne();

		if (!empty($sql->data)) {
			$sql->data->link = 'blog/readmore/'.$sql->data->rewrite_name.'?id='.$sql->data->id;
			if (empty($sql->data->tags)) {
				$sql->data->tags = array();
			} else {
				$sql->data->tags = explode(',', $sql->data->tags);
			}
			$return = $sql->data;
		}
		return $return;
	}

	public function NewView ($id = false)
	{
		if ($id) {
			$id = Common::secureRequest($id);
			$get = New BDD();
			$get->table('TABLE_PAGES_BLOG');
			$where = array(
				'name'  => 'id',
				'value' => (int) $id
			);
			$get->where($where);
			$get->queryOne();
			$data = $get->data;
			if ($get->rowCount != 0) {
				$count = (int) $data->view;
				$count++;
				$update = New BDD();
				$update->table('TABLE_PAGES_BLOG');
				$update->where($where);
				$update->sqlData(array('view' => $count));
				$update->update();
			}
		}
	}
}
