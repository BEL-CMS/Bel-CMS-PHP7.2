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

class Articles extends AdminPages
{
	var $admin  = false; // Admin suprême uniquement (Groupe 1);
	var $active = true;
	var $models = array('ModelsArticles');

	public function index ()
	{
		$data['data'] = $this->ModelsArticles->getAllArticles();
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/Articles?management&pages','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'/articles/add?management&pages','icon'=>'fa fa-plus'));
		$menu[] = array('Configuration'=> array('href'=>'/Articles/parameter?management&pages','icon'=>'fa fa-cubes'));
		$this->render('index', $menu);
	}

	public function edit ($id)
	{
		$data['data'] = $this->ModelsArticles->getArticles($id);
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/articles?management&pages','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'/articles/add?management&pages','icon'=>'fa fa-plus'));
		$menu[] = array('Configuration'=> array('href'=>'/Articles/parameter?management&pages','icon'=>'fa fa-cubes'));
		$this->render('edit', $menu);
	}

	public function sendedit ()
	{
		$return = $this->ModelsArticles->sendEdit($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/articles?management&pages', 2);
	}

	public function parameter ()
	{
		$data['groups'] = BelCMSConfig::getGroups();
		$data['config'] = BelCMSConfig::GetConfigPage(get_class($this));
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/articles?management&pages','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'/articles/add?management&pages','icon'=>'fa fa-plus'));
		$menu[] = array('Configuration'=> array('href'=>'/Articles/parameter?management&pages','icon'=>'fa fa-cubes'));
		$this->render('parameter', $menu);
	}

	public function sendparameter ()
	{
		$return = $this->ModelsArticles->sendparameter($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/Articles/parameter?management&pages', 2);
	}

	public function add ()
	{
		$menu[] = array('Accueil'=> array('href'=>'/articles?management&pages','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'/articles/add?management&pages','icon'=>'fa fa-plus'));
		$menu[] = array('Configuration'=> array('href'=>'/Articles/parameter?management&pages','icon'=>'fa fa-cubes'));
		$this->render('new',$menu);
	}

	public function sendnew ()
	{
		$return = $this->ModelsArticles->sendnew($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/articles?management&pages', 2);
	}

	public function del ($id)
	{
		$return = $this->ModelsArticles->delete($id);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/articles?management&pages', 2);
	}
}