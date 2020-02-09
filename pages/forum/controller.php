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

	public function index ()
	{
		$data['forum'] = $this->ModelsForum->getForum();

		if (empty($data['forum'])) {
			$this->error('Forum', 'Aucun Forum enregistrée en base de donnée.', 'warning');
			return false;
		}

		foreach ($data['forum'] as $k => $v) {
			$data['forum'][$k]->category = $this->ModelsForum->getCatForum($v->id);
			foreach ($data['forum'][$k]->category as $last_k => $last_v) {

				$data['forum'][$k]->category[$last_k]->count = $this->ModelsForum->CountSjForum($data['forum'][$k]->category[$last_k]->id);

				$last = $this->ModelsForum->getLastPostForum($last_v->id);
				if (empty($last)) {
					$data['forum'][$k]->category[$last_k]->last            = (object) array();
					$data['forum'][$k]->category[$last_k]->last->title     = null;
					$data['forum'][$k]->category[$last_k]->last->date_post = null;
					$data['forum'][$k]->category[$last_k]->last->author    = null;
				} else {
					$data['forum'][$k]->category[$last_k]->last = $last;
					/*
					if (Users::ifUserExist($data['forum'][$k]->category[$last_k]->last->author)) {
						$user = Users::getInfosUser($data['forum'][$k]->category[$last_k]->last->author);
						if ($user === false) {
							$data['forum'][$k]->category[$last_k]->last->author = 'Unknow';
						} else {
							$data['forum'][$k]->category[$last_k]->last->author = $user->username;
						}
					} else {
						$data['forum'][$k]->category[$last_k]->last->author = 'Unknow';
					}
					*/
				}
			}
		}

		$this->set($data);
		$this->render('main');
	}

	public function threads ($title, $id)
	{
		$data['id']      = (int) $id;
		$data['threads'] = $this->ModelsForum->GetThreadsPost($data['id']);
		$groupUser       = Users::getGroups($_SESSION['USER']['HASH_KEY']);
		//$current         = current($data['threads']);
		$access          = false;
		$secure          = $this->ModelsForum->securityPost((int) $data['id']);

		if (in_array('1', $groupUser)) {
			$access = true;
		} else {
			if ($secure === true) {
				$access = true;
			} else {
				foreach ($secure as $k_secure => $v_secure) {
					if (in_array($v_secure, $groupUser)) {
						$access = true;
						break;
					}
				}
			}
		}

		if ($access === false) {
			$this->error('Forum', 'Tentative accès non autorisé, un administrateur à été prévenue.', 'error');
			$this->redirect(true, 2);
			return false;
		}

		foreach ($data['threads'] as $k => $v) {
			$data['threads'][$k]->options = Common::transformOpt($v->options);
			$last = $this->ModelsForum->getLastPostsForum($v->id);
			if (empty($last)) {
				$data['threads'][$k]->last = $this->ModelsForum->getLastPostsOriginForum($v->id, $v->id_threads);
			} else {
				$data['threads'][$k]->last = $last;
			}
			
		}

		$this->set($data);
		$this->render('threads');
	}

	public function post ($name = '', $id = '')
	{
		if (empty($name)) {
			$this->error('Forum', 'Page manquante...', 'error');
			$this->redirect('Forum', 3);
			return;
		}
		$d = array();
		$id = (int) $id;
		$_SESSION['REPLYPOST']   = $id;
		$_SESSION['FORUM']       = uniqid('forum_');
		$_SESSION['FORUM_CHECK'] = $_SESSION['FORUM'];
		$this->ModelsForum->addView($id);
		$d['post'] = $this->ModelsForum->GetPosts($name, $id);
		if (count($d['post']) == 0) {
			$this->error('Forum', 'Page manquante...', 'error');
			return;
		} else {
			$this->set($d);
			$this->render('post');
		}
	}

	private function accessLock ($id)
	{
		$groupUser = Users::getGroups($_SESSION['USER']['HASH_KEY']);

		if (in_array('1', $groupUser)) {
			return true;
		}

		$access    = false;
		$forumAccess = $this->ModelsForum->getAccessForum($id);
		foreach ($forumAccess as $k => $v) {
			if (in_array($v, $groupUser)) {
				$access = true;
				break;
			}
		}
		return $access;
	}

	public function lockpost ($id)
	{
			if (self::accessLock($id)) {
				$return = $this->ModelsForum->lock($id);
				$this->error (get_class($this), $return['msg'], $return['type']);
			} else {
				$this->error (get_class($this), NO_CLOSE_POST, 'error');
			}
			$this->redirect('Forum', 2);
	}

	public function unlockpost ($id)
	{
			if (self::accessLock($id)) {
				$return = $this->ModelsForum->unlock($id);
				$this->error (get_class($this), $return['msg'], $return['type']);
			} else {
				$this->error (get_class($this), NO_ACCESS_POST, 'error');
			}
			$this->redirect('Forum', 2);
	}

	public function delpost ($id)
	{
		if (self::accessLock($id)) {
			$return = $this->ModelsForum->delpost($id);
			$this->error (get_class($this), $return['msg'], $return['type']);
		} else {
			$this->error (get_class($this), NO_ACCESS_POST, 'error');
		}
		$this->redirect('Forum', 2);
	}

	public function NewThread ($name)
	{
		$_SESSION['NEWTHREADS'] = $name;
		$this->render('newthread');
	}

	public function send ()
	{
		if ($_REQUEST['send'] == 'SubmitReply') {
			self::SubmitReply($this->data);
		} else if ($_REQUEST['send'] == 'NewThread') {
			self::NewPostThread($this->data);
		}
	}

	private function NewPostThread ($data)
	{
		$insert = $this->ModelsForum->SubmitThread($data['id'], $data);
		$this->error (get_class($this), $insert['msg'], $insert['type']);
		$this->redirect('Forum', 2);
	}

	private function SubmitReply ($data)
	{
		$referer = (!empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : 'Forum';
		$insert  = $this->ModelsForum->SubmitPost($data);
		$this->error (get_class($this), $insert['msg'], $insert['type']);
		$this->redirect('Forum', 2);
	}
}