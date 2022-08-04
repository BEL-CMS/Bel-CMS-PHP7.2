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

class Survey extends AdminPages
{
	var $active    = true;
	var $models    = array('ModelsSurvey');

	public function index ()
	{
		$set['data'] = $this->ModelsSurvey->getAllSurvey();
		$set['count'] = count($set['data']);
		$this->set($set);
		$menu[] = array('Accueil'=> array('href'=>'/survey?management&widgets=true','icon'=>'fa fa-home'));
		$menu[] = array('Configuration'=> array('href'=>'/survey/parameter?management&widgets=true','icon'=>'fa fa-cubes'));
		$menu[] = array('Ajouter'=> array('href'=>'/survey/add?management&widgets=true','icon'=>'fa fa-plus'));
		$this->render('index', $menu);
	}

	public function add ()
	{
		$this->render('add');
	}

	public function send ()
	{
		$return = $this->ModelsSurvey->send($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('survey?management&widgets=true', 2);
	}

	public function delete ($id)
	{
		$id = (int) $id;
		$return = $this->ModelsSurvey->delete($id);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('survey?management&widgets=true', 2);
	}

	public function parameter ()
	{
		$data['groups'] = BelCMSConfig::getGroups();
		$data['config'] = BelCMSConfig::GetConfigWidgets(get_class($this));
		$data['pages']  = Common::ScanDirectory(DIR_PAGES, true);
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/survey?management&widgets=true','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'/survey/add?management&widgets=true','icon'=>'fa fa-plus'));
		$this->render('parameter', $menu);
	}

	public function sendparameter ()
	{
		$return = $this->ModelsSurvey->sendparameter($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('survey/parameter?management&widgets=true', 2);
	}

	public function edit ($id)
	{
		$data['data'] =  $this->ModelsSurvey->editSurvey($id);
		$data['name'] =  $this->ModelsSurvey->surveyQuest($id);
		$data['id']   = $id;
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/survey?management&widgets=true','icon'=>'fa fa-home'));
		$menu[] = array('Configuration'=> array('href'=>'/survey/parameter?management&widgets=true','icon'=>'fa fa-cubes'));
		$menu[] = array('Ajouter'=> array('href'=>'/survey/add?management&widgets=true','icon'=>'fa fa-plus'));
		$this->render('edit', $menu);
	}

	public function sendedit ()
	{
		$return = $this->ModelsSurvey->sendedit($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('survey?management&widgets=true', 2);
	}

	public function del ($id)
	{
		$return = $this->ModelsSurvey->delete($id);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('survey?management&widgets=true', 2);
	}
}