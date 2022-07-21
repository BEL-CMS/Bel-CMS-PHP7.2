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

	public function parameter ()
	{
		$data['groups'] = BelCMSConfig::getGroups();
		$data['config'] = BelCMSConfig::GetConfigPage(get_class($this));
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/gallery?management&pages','icon'=>'fa fa-home'));
		$this->render('parameter', $menu);
	}

	public function cat ()
	{
		$menu[] = array('Accueil'=> array('href'=>'/gallery?management&pages','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'/gallery/add?management&pages','icon'=>'fa fa-plus'));
		$menu[] = array('Configuration'=> array('href'=>'/gallery/parameter?management&pages','icon'=>'fa fa-cubes'));
		$this->render('cat', $menu);
	}

}