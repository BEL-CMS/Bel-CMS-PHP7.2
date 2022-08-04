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

class Articles extends AdminPages
{
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