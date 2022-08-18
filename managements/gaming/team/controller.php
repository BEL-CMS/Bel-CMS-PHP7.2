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

class Team extends AdminPages
{
	var $admin  = true; // Admin suprême uniquement (Groupe 1);
	var $active = true;
	var $models = array('ModelsTeam');

	public function index ()
	{
		$data['data'] = $this->ModelsTeam->getTeam ();
		$data['count'] = count($data['data']);
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'team?management&gaming=true','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'Team/addTeam?management&gaming=true','icon'=>'fa fa-plus'));
		$this->render('index', $menu);
	}

	public function addTeam ()
	{
		$data['game'] = $this->ModelsTeam->getGames ();
		$this->set($data);
		$this->render('add');
	}

	public function edit ($id)
	{
		if ($id && is_numeric($id)) {
			$data['data'] = $this->ModelsTeam->getTeam ($id);
			$data['game'] = $this->ModelsTeam->getGames ();
			$this->set($data);
			$this->render('edit');
		}
	}

	public function sendEdit ()
	{
		$return = $this->ModelsTeam->SendEdit ($_POST);
		$this->error(get_class($this), $return['msg'], $return['type']);
		$this->redirect('team?management&gaming=true', 2);
	}

	public function sendAdd ()
	{
		if (empty($_POST)) {
			$this->error(get_class($this), 'Champ vide', 'warning');
		} else {
			$return = $this->ModelsTeam->SendAdd ($_POST);
			$this->error(get_class($this), $return['msg'], $return['type']);
			$this->redirect('team?management&gaming=true', 2);
		}
	}

	public function player ($id)
	{
		if ($id && is_numeric($id)) {
			$data['team'] = $this->ModelsTeam->getTeam ($id);
			$data['user'] = $this->ModelsTeam->getUsers ();
			$userTeam = $this->ModelsTeam->getUsersTeam ($id);
			foreach ($userTeam as $k => $v) {
				$data['userTeam'][] = $v->author;
			}
			if (empty($userTeam)) {
				$data['userTeam'] = array();
			}
			$this->set($data);
			$menu[] = array('Accueil'=> array('href'=>'/team?management&gaming=true','icon'=>'fa fa-home'));
			$menu[] = array('Configurations'=> array('href'=>'/Team/cobfig?management&gaming=true','icon'=>'fa fas fa-plus'));
			$this->render('player', $menu);
		}
	}

	public function playerEdit ()
	{
		$return = $this->ModelsTeam->sendPlayerEdit ($_POST);
		$this->error(get_class($this), $return['msg'], $return['type']);
		$this->redirect(true, 0);
	}

	public function del ($id)
	{
		if ($id && is_numeric($id)) {
			$return = $this->ModelsTeam->del ($id);
			$this->error(get_class($this), $return['msg'], $return['type']);
			$this->redirect('team?management&gaming=true', 2);
		}
	}
}