<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
 * @link http://www.bel-cms.be
 * @link http://www.stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2019 Bel-CMS
 * @author Stive - mail@stive.eu
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class Forum extends Pages
{
	var $models = array('ModelsForum');
	private $_error = false;

	public function index ()
	{
		$data['forum']     = $this->ModelsForum->getForum();
		$data['threads']   = $this->ModelsForum->getThreads();

		$i = 0;
		foreach ($data['threads'] as $k => $v) {
			$i++;
			if (array_key_exists($v->id_forum, $data['forum'])) {
				$data['data'][$v->id_forum] = $data['forum'][$v->id_forum];
				$data['data'][$v->id_forum]->threads[$i] = $v;
				$data['data'][$v->id_forum]->threads[$i]->count = $this->ModelsForum->getCountPost($v->id);
				$data['data'][$v->id_forum]->threads[$i]->last = $this->ModelsForum->getLastPost($v->id);
				$data['data'][$v->id_forum]->threads[$i]->id_threads = $v->id;
			}
		}

		$this->set($data);
		$this->render("main");
	}

	public function threads ($title, $id)
	{
		$data['title'] = Common::VarSecure($title);
		$data['post']  = $this->ModelsForum->getPost($id);
		$data['id']    = $id;

		foreach ($data['post'] as $k => $v) {
			$data['post'][$k]->last = $this->ModelsForum->getLastPosts($v->id);
		}

		foreach ($data['post'] as $key => $value) {
			$data['post'][$key]->options = Common::transformOpt($value->options);
			if (!empty($v->author) && strlen($v->author) == 32) {
				if (Users::ifUserExist($v->author)) {
					$user     = Users::getInfosUser($v->author);
					$username = $user[$v->author]->username;
					$data['post'][$key]->author = $username;
				} else {
					$data['post'][$key]->author = 'Inconnu';
				}
			} else {
				$data['post'][$key]->author = 'Inconnu';
			}
			$data['post'][$key]->date_post = Common::TransformDate($value->date_post, 'MEDIUM', 'SHORT');
		}

		$this->set($data);
		$this->render("threads");
	}

	public function NewThread ($id)
	{
		$data['id'] = $id;
		$this->set($data);
		$this->render("newthreads");
	}

	public function SendNewPost ($id)
	{
		if (empty($id) or !is_numeric($id)) {
			$this->error('Erreur', 'ID Inconnu', 'error');
		} else {
			$return = $this->ModelsForum->AddPost($id, $this->data);
			$this->error($return['title'], $return['msg'], $return['type']);
			$this->redirect('Forum/Threads', 2);
		}
	}
}