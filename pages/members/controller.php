<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class Members extends Pages
{
	var $models = array('ModelsMembers');

	public function index ()
	{
		$set['pagination'] = $this->pagination(10, get_class($this), TABLE_USERS);
		$set['members'] = $this->ModelsMembers->GetUsers();
		$this->set($set);
		$this->render('index');
	}

	public function view ($name)
	{
		$data['groups'] = Secures::getGroups();
		$data['data']   = $this->ModelsMembers->getViewUser($name);
		if (empty($data['data'])) {
			Notification::warning('L\'utilisateur demandé n\'existe pas');
		} else {
			$this->set($data);
			$this->render('view');
		}
	}

	public function AddFriend ($id)
	{
		$user = Users::getInfosUser($id, true);
		if ($user['username'] == DELETE) {
			Notification::error(UNKNOW_MEMBER, FRIEND);
		} else {
			if ($this->ModelsMembers->addFriendSQL ($user['hash_key'] == null)) {
				Notification::warning(ADD_FRIEND_ERROR, FRIEND);
			} else {
				Notification::success(ADD_FRIEND_SUCCESS, FRIEND);
			}
			$this->redirect(true, 2);
		}
	}

	public function json ()
	{
		$data = $this->ModelsMembers->getJson();
		echo json_encode($data);
	}
}
