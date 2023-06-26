<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.2.0
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

class Survey extends AdminPages
{
	var $active    = true;
	var $models    = array('ModelsSurvey');

	public function index ()
	{
		$data['data']  = $this->ModelsSurvey->getAllSurvey();
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/survey?management&widgets','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'/survey/add?management&widgets','icon'=>'fa fa-plus-circle'));
		$menu[] = array('Configuration'=> array('href'=>'/survey/parameter?management&widgets','icon'=>'fa fa-cubes'));
		$this->render('index', $menu);
	}
	public function add()
	{
		$this->render('add');	
	}
	public function send()
	{
		$return = $this->ModelsSurvey->send($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/survey?management&widgets', 2);
	}
	public function parameter ()
	{
		$data['groups'] = BelCMSConfig::getGroups();
		$data['config'] = BelCMSConfig::GetConfigWidgets(get_class($this));
		$data['pages']  = Common::ScanDirectory(DIR_PAGES, true);
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/survey?management&widgets','icon'=>'fa fa-home'));
		$this->render('parameter', $menu);
	}
	public function sendparameter ()
	{
		$return = $this->ModelsSurvey->sendparameter($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('Survey?management&widgets', 2);
	}
}