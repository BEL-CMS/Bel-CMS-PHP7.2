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
		$menu[] = array('Accueil'=> array('href'=>'/downloads?management&page=true','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'/downloads/add?management&page=true','icon'=>'fa fa-plus'));
		$menu[] = array('Câtegories'=> array('href'=>'/downloads/cat?management&page=true','icon'=>'fa fa-cogs'));
		$menu[] = array('Configuration'=> array('href'=>'/downloads/parameter?management&page=true','icon'=>'fa fa-cubes'));
		$this->render('index', $menu);
	}

	public function add ()
	{
		$cat = $this->ModelsDownloads->getCat();
		$countCat = count($cat);

		if ($countCat == 0) {
			$this->error(get_class($this), 'Une catégorie est obligatoire', 'warning');
			$this->redirect('/downloads/addcat?management&page=true', 2);

		} else {
			$d['cat'] = $cat;
			$this->set($d);
			$this->render('add');
		}
	}

	public function edit ($id = null)
	{
		$cat = $this->ModelsDownloads->getCat();
		$countCat = count($cat);
		if ($countCat == 0) {
			$this->error(get_class($this), 'Une catégorie est obligatoire', 'warning');
			$this->redirect('/downloads/addcat?management&page=true', 2);

		} else {
			$d['data'] = $this->ModelsDownloads->getDL($id);
			$d['cat']  = $cat;
			$this->set($d);
			$this->render('edit');
		}
	}

	public function sendadd ()
	{
		$return = $this->ModelsDownloads->sendadd ($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/downloads?management&page=true', 2);
	}

	public function del ($id)
	{
		$id = (int) $id;
		$return = $this->ModelsDownloads->del($id);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/downloads?management&page=true', 2);
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
		$this->redirect('/downloads/cat?management&page=true', 2);
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
		$this->redirect('/downloads/cat?management&page=true', 2);
	}

	public function delcat ($id)
	{
		$return = $this->ModelsDownloads->delcat($id);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/downloads/cat?management&page=true', 2);
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
		$return = $this->ModelsDownloads->sendparameter($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/downloads?management&page=true', 2);
	}

}