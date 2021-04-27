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

class Games extends AdminPages
{
	var $active = true;
	var $models = array('ModelsGames');

	public function index ()
	{
		$data['data'] = $this->ModelsGames->getGames();
		$data['count'] = count($data['data']);
		$this->set($data);
		$this->render('index');
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