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

class Shoutbox extends AdminPages
{
	var $active    = true;
	var $models    = array('ModelsShoutbox');

	public function index ()
	{
		$data['data'] = $this->ModelsShoutbox->getAllMsg();
		$data['count'] = $this->ModelsShoutbox->getNbMsg();
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/shoutbox?management&widgets=true','icon'=>'fa fa-home'));
		$menu[] = array('Configuration'=> array('href'=>'/shoutbox/parameter?management&widgets=true','icon'=>'fa fa-cubes'));
		$menu[] = array('Effacer tout'=> array('href'=>'/shoutbox/deleteall?management&widgets=true','icon'=>'fa fa-ban'));
		$this->render('index', $menu);
	}

	public function edit ($id)
	{
		$data['data'] = $this->ModelsShoutbox->getMsg($id);
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/shoutbox?management&widgets=true','icon'=>'fa fa-home'));
		$menu[] = array('Configuration'=> array('href'=>'/shoutbox/parameter?management&widgets=true','icon'=>'fa fa-cubes'));
		$menu[] = array('Effacer tout'=> array('href'=>'/shoutbox/deleteall?management&widgets=true','icon'=>'fa fa-ban'));
		$this->render('edit', $menu);
	}

	public function sendedit ()
	{
		$return = $this->ModelsShoutbox->sendEdit($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('Shoutbox?management&widgets=true', 2);
	}

	public function delete ($id)
	{
		$return = $this->ModelsShoutbox->delete($id);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('Shoutbox?management&widgets=true', 2);
	}

	public function deleteall ()
	{
		$return = $this->ModelsShoutbox->deleteAll();
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('Shoutbox?management&widgets=true', 2);
	}

	public function parameter ()
	{
		$data['groups'] = BelCMSConfig::getGroups();
		$data['config'] = BelCMSConfig::GetConfigWidgets(get_class($this));
		$data['pages']  = Common::ScanDirectory(DIR_PAGES, true);
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/shoutbox?management&widgets=true','icon'=>'fa fa-home'));
		$menu[] = array('Configuration'=> array('href'=>'/shoutbox/parameter?management&widgets=true','icon'=>'fa fa-cubes'));
		$menu[] = array('Effacer tout'=> array('href'=>'/shoutbox/deleteall?management&widgets=true','icon'=>'fa fa-ban'));
		$this->render('parameter', $menu);
	}

	public function sendparameter ()
	{
		$return = $this->ModelsShoutbox->sendparameter($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('shoutbox?management&widgets=true', 2);
	}
}