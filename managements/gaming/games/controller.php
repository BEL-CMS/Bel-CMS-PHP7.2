<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class Games extends AdminPages
{
	var $admin  = true; // Admin suprême uniquement (Groupe 1);
	var $active = true;
	var $models = array('ModelsGames');

	public function index ()
	{
		$data['data'] = $this->ModelsGames->getGames();
		$data['count'] = count($data['data']);
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/games?management&gaming=true','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'/games/add?management&gaming=true','icon'=>'fa fa-plus'));
		$menu[] = array('Configurations'=> array('href'=>'Team/addTeam?management&gaming=true','icon'=>'fa fa-cubes'));
		$this->render('index', $menu);;
	}

	public function add ()
	{
		$this->render('add');
	}

	public function addGame ()
	{
		$return = $this->ModelsGames->addGame ($_POST);
		$this->error(get_class($this), $return['msg'], $return['type']);
		$this->redirect('games?management&gaming=true', 2);
	}

	public function edit ($id)
	{
		$data['data'] = $this->ModelsGames->getGames($id);
		$this->set($data);
		$this->render('edit');
	}

	public function editGame ()
	{
		$return = $this->ModelsGames->editGame ($_POST);
		$this->error(get_class($this), $return['msg'], $return['type']);
		$this->redirect('games?management&gaming=true', 2);
	}

	public function delGame ($id = null)
	{
		if ($id && is_numeric($id)) {
			$return = $this->ModelsGames->delGame($id);
			$this->error(get_class($this), $return['text'], $return['type']);
			$this->redirect('games?management&gaming=true', 2);
		}
	}
}