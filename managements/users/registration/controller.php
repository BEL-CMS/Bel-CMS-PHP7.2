<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.2
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit('<!doctype html><html><head><meta charset="utf-8"><title>BEL-CMS : Error 403 Forbidden</title><style>h1{margin: 20px auto;text-align:center;color: red;}p{text-align:center;font-weight:bold;</style></head><body><h1>HTTP Error 403 : Forbidden</h1><p>You don\'t permission to access / on this server.</p></body></html>');
}

class Registration extends AdminPages
{
	var $admin     = true; // Admin suprême uniquement (Groupe 1);
	var $active    = true;
	var $models    = array('ModelsUsers');

	public function index ()
	{
		$data['user'] = $this->ModelsUsers->getAllUsers();
		$this->set($data);
		$this->render('index');
	}

	public function edit ($id)
	{
		$data['user']   = current($this->ModelsUsers->getAllUsers($id));
		$data['profil'] = current($this->ModelsUsers->getAllUsersProfils($id));
		$data['social'] = current($this->ModelsUsers->getAllUsersSocial($id));
		$this->set($data);
		$this->render('edition');
	}

	public function del ($id)
	{
		if (Common::hash_key($id)) {
			if ($id == $_SESSION['USER']['HASH_KEY']) {
				$this->error(get_class($this), 'Vous ne pouvez pas vous efacer vous même', 'error');
				return;
			}
		}
	}

	public function sendPrivate ($id = null)
	{
		if ($id !== null && is_numeric($id)) {
			$_POST['id'] = (int) $id;
			$return = $this->ModelsUsers->sendPrivate($_POST);
			$this->error(get_class($this), $return['text'], $return['type']);
		} else {
			$this->error(get_class($this), 'No is valid', 'error');
		}
		$this->redirect('/registration?&users&management', 2);
	}

	public function sendMainGroup ()
	{
		$return = $this->ModelsUsers->sendMainGroup($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/registration?&users&management', 2);
	}

	public function sendSecondGroup ()
	{
		$return = $this->ModelsUsers->sendSecondGroup($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/registration?&users&management', 2);
	}

	public function sendSocial ()
	{
		$return = $this->ModelsUsers->sendSocial($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/registration?&users&management', 2);
	}

	public function sendInfoPublic ()
	{
		$return = $this->ModelsUsers->sendInfoPublic($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/registration?&users&management', 2);
	}
}