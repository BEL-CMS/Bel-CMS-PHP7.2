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

class Downloads extends AdminPages
{
	var $active = true;
	var $models = array('ModelsDownloads');

	public function index ()
	{
		$d['data']  = $this->ModelsDownloads->getAllDl();
		$d['count'] = count($d['data']);
		$this->set($d);
		$this->render('index');
	}

	public function add ()
	{
		$this->render('add');
	}

	public function cat ()
	{
		$d['data']  = $this->ModelsDownloads->getCat();
		$d['count'] = count($d['data']);
		$this->set($d);
		$this->render('cat');
	}

	public function addcat ()
	{
		$d['groups'] = BelCMSConfig::getGroups();
		$this->set($d);
		$this->render('addcat');
	}

	public function sendnewcat ()
	{
		if ($this->ModelsDownloads->testName($_POST['name'])) {
			$return = $this->ModelsDownloads->sendnewcat($_POST);
			$this->error(get_class($this), $return['text'], $return['type']);
		} else {
			$this->error(get_class($this), 'Le nom de la catégorie à déjà été pris', 'warning');
		}
		$this->redirect('downloads/cat?management&page=true', 2);
	}

	public function editcat ($id)
	{
		$d['data']   = current($this->ModelsDownloads->getCat($id));
		$d['groups'] = BelCMSConfig::getGroups();
		$this->set($d);
		$this->render('editcat');
	}

	public function sendeditcat ()
	{
		$return = $this->ModelsDownloads->sendeditcat($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('downloads/cat?management&page=true', 2);
	}

	public function delcat ($id)
	{
		$return = $this->ModelsDownloads->delcat($id);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('downloads/cat?management&page=true', 2);
	}

}