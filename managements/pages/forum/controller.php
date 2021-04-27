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

class Forum extends AdminPages
{
	var $active = true;
	var $models = array('ModelsForum');

	public function index ()
	{
		$data['data'] = $this->ModelsForum->GetThreads();
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/Forum?management&page=true','icon'=>'fa fa-home'));
		$menu[] = array('Configuration'=> array('href'=>'/Forum/parameter?management&page=true','icon'=>'fa fa-cubes'));
		$menu[] = array(CATEGORY=> array('href'=>'/Forum/category?management&page=true','icon'=>'fa fa-th-large'));
		$menu[] = array(ADD=> array('href'=>'/Forum/AddForum?management&page=true','icon'=>'fa fa-plus'));
		$this->render('index', $menu);
	}

	public function category ()
	{
		$data['data'] = $this->ModelsForum->GetForum();
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/Forum?management&page=true','icon'=>'fa fa-home'));
		$menu[] = array('Configuration'=> array('href'=>'/Forum/parameter?management&page=true','icon'=>'fa fa-cubes'));
		$menu[] = array(CATEGORY=> array('href'=>'/Forum/category?management&page=true','icon'=>'fa fa-th-large'));
		$menu[] = array(ADD=> array('href'=>'/Forum/addcategory?management&page=true','icon'=>'fa fa-plus'));
		$this->render('category', $menu);
	}

	public function addcategory ()
	{
		$data['groups'] = BelCMSConfig::getGroups();
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/Forum?management&page=true','icon'=>'fa fa-home'));
		$menu[] = array('Configuration'=> array('href'=>'/Forum/parameter?management&page=true','icon'=>'fa fa-cubes'));
		$menu[] = array(CATEGORY=> array('href'=>'/Forum/category?management&page=true','icon'=>'fa fa-th-large'));
		$menu[] = array(ADD=> array('href'=>'/Forum/addcategory?management&page=true','icon'=>'fa fa-plus'));
		$this->render('addcategory', $menu);
	}

	public function editCat ($id)
	{
		if ($this->ModelsForum->SecureCat($id) === true) {
			$data['groups'] = BelCMSConfig::getGroups();
			$data['data']   = $this->ModelsForum->GetForum($id);
			$this->set($data);
			$this->render('editcategory');			
		} else {
			$this->error(get_class($this), NO_ACCESS_CAT, 'error');
			Common::Redirect('Forum/category?management&page=true', 2);
		}
	}

	public function delCategory ($id)
	{
		if ($this->ModelsForum->SecureCat($id) === true) {
			$return = $this->ModelsForum->delCat($id);
			$this->error(get_class($this), $return['text'], $return['type']);
			Common::Redirect('Forum/Category?management', 2);
		} else {
			$this->error(get_class($this), NO_ACCESS_CAT, 'error');
		}
		Common::Redirect('Forum/category?management&page=true', 2);
	}

	public function addforum ()
	{
		$data['data'] = $this->ModelsForum->GetForum();
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/Forum?management&page=true','icon'=>'fa fa-home'));
		$menu[] = array('Configuration'=> array('href'=>'/Forum/parameter?management&page=true','icon'=>'fa fa-cubes'));
		$menu[] = array(CATEGORY=> array('href'=>'/Forum/category?management&page=true','icon'=>'fa fa-th-large'));
		$this->render('addforum', $menu);
	}

	public function editForum($id)
	{
		if (is_numeric($id)) {
			$data['thread'] = $this->ModelsForum->GetThreads($id);
			$data['data'] = $this->ModelsForum->GetForum();
			$this->set($data);
			$this->render('editforum');
		}
	}
	# Send
	public function send ()
	{
		//$this->debug($_POST); return;
		if ($_POST['send'] == 'addforum') {
			$return = $this->ModelsForum->sendAddForum($_POST);
		} else if ($_POST['send'] == 'editforum') {
			$return = $this->ModelsForum->sendEditForum($_POST);
		} else if ($_POST['send'] == 'addcat') {
			if ($this->ModelsForum->isCat($_POST['title'])) {
				$return = $this->ModelsForum->SendAddCat($_POST);
			} else {
				$this->error(get_class($this), CAT_IF_EXIST, 'infos');
				Common::Redirect('Forum/addcategory?management&page=true', 2);
				return;
			}
		} elseif ($_POST['send'] == 'editcat') {
			$return = $this->ModelsForum->sendEditCat($_POST);
			Common::Redirect('Forum/category?management&page=true', 2);
			$this->error(get_class($this), $return['text'], $return['type']);
			return;
		}

		$this->error(get_class($this), $return['text'], $return['type']);

		Common::Redirect('Forum?management&page=true', 2);
	}

	public function delForum ($id)
	{
		$return = $this->ModelsForum->delThreads($id);
		$this->error(get_class($this), $return['text'], $return['type']);
		Common::Redirect('Forum?management&page=true', 2);
	}

	public function parameter ()
	{
		$data['groups'] = BelCMSConfig::getGroups();
		$data['config'] = BelCMSConfig::GetConfigPage(get_class($this));
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/Forum?management&page=true','icon'=>'fa fa-home'));
		$menu[] = array('Configuration'=> array('href'=>'/Forum/parameter?management&page=true','icon'=>'fa fa-cubes'));
		$menu[] = array(CATEGORY=> array('href'=>'/Forum/category?management&page=true','icon'=>'fa fa-th-large'));
		$menu[] = array(ADD=> array('href'=>'/Forum/AddForum?management&page=true','icon'=>'fa fa-plus'));
		$this->render('parameter', $menu);
	}

	public function sendparameter ()
	{
		$return = $this->ModelsForum->sendparameter($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('Forum?management&page=true', 2);
	}
}