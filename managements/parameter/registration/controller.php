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
				$this->error(get_class($this), 'Vous ne pouvez pas vous efacer vous m\'aimee', 'error');
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
		$this->redirect('registration?management&parameter=true', 2);
	}

	public function sendMainGroup ()
	{
		$return = $this->ModelsUsers->sendMainGroup($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('registration?management&parameter=true', 2);
	}

	public function sendSecondGroup ()
	{
		$return = $this->ModelsUsers->sendSecondGroup($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('registration?management&parameter=true', 2);
	}

	public function sendSocial ()
	{
		$return = $this->ModelsUsers->sendSocial($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('registration?management&parameter=true', 2);
	}

	public function sendInfoPublic ()
	{
		$return = $this->ModelsUsers->sendInfoPublic($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('registration?management&parameter=true', 2);
	}
}