<?php
/**
 * Bel-CMS [Content management system]
 * @version 1.0.0
 * @link https://bel-cms.be
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2014-2021 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class donates extends AdminPages
{
	var $admin  = true;
	var $active = true;
	var $models = array('ModelsDonates');

	public function index ()
	{
		$data['dons'] = $this->ModelsDonates->getDons();
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/donates?management&widgets=true','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'/donates/don?management&widgets=true','icon'=>'fa fa-plus'));
		$menu[] = array('Configuration'=> array('href'=>'/donates/parameter?management&widgets=true','icon'=>'fa fa-cubes'));
		$this->render('index', $menu);
	}

	public function don ()
	{
		$data['users'] = $this->ModelsDonates->GetUsers();
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/donates?management&widgets=true','icon'=>'fa fa-home'));
		$menu[] = array('Configuration'=> array('href'=>'/donates/parameter?management&widgets=true','icon'=>'fa fa-cubes'));
		$this->render('don', $menu);
	}

	public function senddon ()
	{
		$return = $this->ModelsDonates->senddon ($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/donates?management&widgets=true', 2);
	}

	public function parameter ()
	{
		$data['groups'] = BelCMSConfig::getGroups();
		$data['config'] = BelCMSConfig::GetConfigWidgets(get_class($this));
		$data['pages']  = Common::ScanDirectory(DIR_PAGES, true);
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/donates?management&widgets=true','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'/donates/don?management&widgets=true','icon'=>'fa fa-plus'));
		$this->render('parameter', $menu);
	}

	public function sendparameter ()
	{
		$return = $this->ModelsDonates->sendparameter($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/donates?management&widgets=true', 2);
	}
}