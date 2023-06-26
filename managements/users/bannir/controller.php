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

class Bannir extends AdminPages
{
	var $admin  = true; // Admin suprême uniquement (Groupe 1);
	var $active = true; // activation manuel;
	var $models = array('Modelsbannir');

	public function index ()
	{
		$menu[] = array('Accueil'=> array('href'=>'/bannir?management&users','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'/bannir/add?management&users','icon'=>'fa fa-plus'));
		$data['ban'] = $this->Modelsbannir->getUsersBan();
		$this->set($data);
		$this->render('index', $menu);
	}

	public function add ()
	{
		$data['author'] = $this->Modelsbannir->getUsers();
		$menu[]         = array('Accueil'=> array('href'=>'/bannir?management&users','icon'=>'fa fa-home'));
		$this->set($data);
		$this->render('add', $menu);
	}

	public function sendadd ()
	{
		$return = $this->Modelsbannir->sendadd($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('bannir?management&users', 2);
	}

	public function ban ($hash_key)
	{
		$return = $this->Modelsbannir->sendBan($hash_key);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('bannir?management&users', 2);
	}

	function debannir ($hash_key)
	{
		$return = $this->Modelsbannir->sendDeBan ($hash_key);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('bannir?management&users', 2);
	}

	public function del ($id)
	{
		$return = $this->Modelsbannir->del($id);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('bannir?management&users', 2);
	}
}