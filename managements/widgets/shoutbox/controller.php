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
		$this->render('index');
	}

	public function edit ($id)
	{
		$data['data'] = $this->ModelsShoutbox->getMsg($id);
		$this->set($data);
		$this->render('edit');
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
		$this->render('parameter');
	}

	public function sendparameter ()
	{
		$return = $this->ModelsShoutbox->sendparameter($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('shoutbox?management&widgets=true', 2);
	}
}