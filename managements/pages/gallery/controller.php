<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.1
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

class Gallery extends AdminPages
{
	var $active = true;
	var $models = array('ModelsGallery');

	public function index ()
	{
		$menu[] = array('Accueil'=> array('href'=>'/gallery?management&pages','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'/gallery/add?management&pages','icon'=>'fa fa-plus'));
		$menu[] = array('Câtegories'=> array('href'=>'/gallery/cat?management&pages','icon'=>'fa fa-cogs'));
		$menu[] = array('Configuration'=> array('href'=>'/gallery/parameter?management&pages','icon'=>'fa fa-cubes'));
		$this->render('index', $menu);
	}

	public function add ()
	{
		$this->render('add');
	}

	public function sendadd ()
	{
		$return = $this->ModelsGallery->sendadd ($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/gallery?management&pages', 2);
	}

	public function parameter ()
	{
		$menu[] = array('Accueil'=> array('href'=>'/gallery?management&pages','icon'=>'fa fa-home'));
		$data['groups'] = BelCMSConfig::getGroups();
		$data['config'] = BelCMSConfig::GetConfigPage(get_class($this));
		$this->set($data);
		$this->render('parameter', $menu);
	}

	public function sendparameter ()
	{
		$return = $this->ModelsGallery->sendparameter($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/gallery?management&pages', 2);
	}

	public function cat ()
	{
		$menu[] = array('Accueil'=> array('href'=>'/gallery?management&pages','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'/gallery/add?management&pages','icon'=>'fa fa-plus'));
		$menu[] = array('Configuration'=> array('href'=>'/gallery/parameter?management&pages','icon'=>'fa fa-cubes'));
		$this->render('cat', $menu);
	}

}