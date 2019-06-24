<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
 * @link https://bel-cms.be
 * @link https://stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2019 Bel-CMS
 * @author Stive - determe@stive.eu
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class Blog extends AdminPages
{
	var $active = true;
	var $models = array('ModelsBlog');

	public function index ()
	{
		$data['data'] = $this->ModelsBlog->getAllBlog();
		$data['count'] = $this->ModelsBlog->getNbBlog();
		$this->set($data);
		$this->render('index');
	}

	public function edit ($id)
	{
		$data['data'] = $this->ModelsBlog->getBlog($id);
		$this->set($data);
		$this->render('edit');
	}

	public function sendedit ()
	{
		$return = $this->ModelsBlog->sendEdit($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('blog?management&page=true', 2);
	}

	public function parameter ()
	{
		$data['groups'] = BelCMSConfig::getGroups();
		$data['config'] = BelCMSConfig::GetConfigPage(get_class($this));
		$this->set($data);
		$this->render('parameter');
	}

	public function sendparameter ()
	{
		$return = $this->ModelsBlog->sendparameter($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('blog?management&page=true', 2);
	}

	public function add ()
	{
		$this->render('new');
	}

	public function sendnew ()
	{
		$return = $this->ModelsBlog->sendnew($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('blog?management&page=true', 2);
	}

	public function del ($id)
	{
		$return = $this->ModelsBlog->delete($id);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('blog?management&page=true', 2);
	}
}