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

class Page extends AdminPages
{
	var $active = true;
	var $models = array('ModelsPage');

	public function index ()
	{
		$set['data'] = $this->ModelsPage->getPages();
		$this->set($set);
		$this->render('index');
	}

	public function add ()
	{
		$data['groups'] = BelCMSConfig::getGroups();
		$this->set($data);
		$this->render('addpage');
	}

	public function edit ($id)
	{
		$id = (int) $id;
		$set['groups'] = BelCMSConfig::getGroups();
		$set['data']   = $this->ModelsPage->getPage($id);
		$this->set($set);
		$this->render('edit');
	}

	public function sendnew ()
	{
		$return = $this->ModelsPage->addNewPage($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('page?management&page=true', 2);
	}

	public function sendedit ()
	{
		$return = $this->ModelsPage->sendedit ($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('page?management&page=true', 2);
	}
}