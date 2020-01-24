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
		foreach ($set['data'] as $key => $value) {
			if (Secures::IsAcess($value->groups) == false) {
				unset($set['data'][$key]);
			}
		}
		$this->set($set);
		$this->render('index');
	}

	public function getpage ($id = false)
	{
		$set['data'] = $this->ModelsPage->getPagecontent($id);
		$set['name'] = $this->ModelsPage->getPage($id)->name;
		$set['id']   = (int) $id;
 		$this->set($set);
		$this->render('page');
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
		if (empty($_POST['name'])) {
			$this->error(get_class($this), 'Aucun nom', 'error');
			$this->redirect('page?management&page=true', 2);
		} else {
			$return = $this->ModelsPage->addNewPage($_POST);
			$this->error(get_class($this), $return['text'], $return['type']);
			$this->redirect('page?management&page=true', 2);			
		}
	}

	public function sendedit ()
	{
		$return = $this->ModelsPage->sendedit ($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('page?management&page=true', 2);
	}

	public function addsubpage ($id)
	{
		$set['data'] = $this->ModelsPage->getPage($id);
		$this->set($set);
		$this->render('subpage');
	}

	public function sendnewsub ()
	{
		$return = $this->ModelsPage->sendnewsub ($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('page?management&page=true', 2);
	}

	public function subpageedit ($id)
	{
		$id = (int) $id;
		$set['data'] = $this->ModelsPage->getPagecontentId($id);
		$this->set($set);
		$this->render('subpageedit');
	}

	public function sendeditsub ()
	{	
		$return = $this->ModelsPage->sendeditsub ($_POST);		
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('page?management&page=true', 2);
	}

	public function delsubpage ($id = false)
	{
		$id = (int) $id;
		$return = $this->ModelsPage->deletesub($id);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('page?management&page=true', 2);
	}

	public function deleteAll ($id)
	{
		$id  = (int) $id;
		$return = $this->ModelsPage->deleteAll($id);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('page?management&page=true', 2);
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
		$return = $this->ModelsPage->sendparameter($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('Page?management&page=true', 2);
	}
}