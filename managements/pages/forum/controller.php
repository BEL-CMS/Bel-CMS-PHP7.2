<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.1
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

class Forum extends AdminPages
{
	var $admin  = false; // Admin suprême uniquement (Groupe 1);
	var $active = true;
	var $models = array('ModelsForum');

	public function index ()
	{
		$data['data'] = $this->ModelsForum->GetThreads();
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/Forum?management&pages','icon'=>'fa fa-home'));
		$menu[] = array('Configuration'=> array('href'=>'/Forum/parameter?management&pages','icon'=>'fa fa-cubes'));
		$menu[] = array(CATEGORY=> array('href'=>'/Forum/category?management&pages','icon'=>'fa fa-th-large'));
		$menu[] = array(ADD=> array('href'=>'/Forum/AddForum?management&pages','icon'=>'fa fa-plus'));
		$menu[] = array(ALL=> array('href'=>'/Forum/allMsg?management&pages','icon'=>'fa fa-pencil'));
		$this->render('index', $menu);
	}

	public function category ()
	{
		$data['data'] = $this->ModelsForum->GetForum();
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/Forum?management&pages','icon'=>'fa fa-home'));
		$menu[] = array('Configuration'=> array('href'=>'/Forum/parameter?management&pages','icon'=>'fa fa-cubes'));
		$menu[] = array(CATEGORY=> array('href'=>'/Forum/category?management&pages','icon'=>'fa fa-th-large'));
		$menu[] = array(ADD=> array('href'=>'/Forum/addcategory?management&pages','icon'=>'fa fa-plus'));
		$menu[] = array(ALL=> array('href'=>'/Forum/allMsg?management&pages','icon'=>'fa fa-pencil'));
		$this->render('category', $menu);
	}

	public function allMsg ()
	{
		$data['data'] = $this->ModelsForum->GettAllPosts();
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/Forum?management&pages','icon'=>'fa fa-home'));
		$menu[] = array('Configuration'=> array('href'=>'/Forum/parameter?management&pages','icon'=>'fa fa-cubes'));
		$menu[] = array(CATEGORY=> array('href'=>'/Forum/category?management&pages','icon'=>'fa fa-th-large'));
		$menu[] = array(ADD=> array('href'=>'/Forum/addcategory?management&pages','icon'=>'fa fa-plus'));
		$menu[] = array(ALL=> array('href'=>'/Forum/allMsg?management&pages','icon'=>'fa fa-pencil'));
		$this->render('allmsg', $menu);
	}

	public function editmessage ($id)
	{	
		$data['data'] = $this->ModelsForum->GetEditPost($id);
		$this->set($data);
		$this->render('editmessage');
	}

	public function sendeditmessage ()
	{
		$forum = $this->ModelsForum->sendEditPost($_POST);
		$this->redirect('Forum/allMsg?management&pages', 2);
		$this->error(get_class($this), $forum["msg"], $forum["type"]);
	}

	public function delMessage ($id)
	{
		$forum = $this->ModelsForum->sendDelPost($id);
		$this->redirect('Forum/allMsg?management&pages', 2);
		$this->error(get_class($this), $forum["text"], $forum["type"]);
	}

	public function addcategory ()
	{
		$data['groups'] = BelCMSConfig::getGroups();
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/Forum?management&pages','icon'=>'fa fa-home'));
		$menu[] = array('Configuration'=> array('href'=>'/Forum/parameter?management&pages','icon'=>'fa fa-cubes'));
		$menu[] = array(CATEGORY=> array('href'=>'/Forum/category?management&pages','icon'=>'fa fa-th-large'));
		$menu[] = array(ADD=> array('href'=>'/Forum/addcategory?management&pages','icon'=>'fa fa-plus'));
		$menu[] = array(ALL=> array('href'=>'/Forum/allMsg?management&pages','icon'=>'fa fa-pencil'));
		$this->render('addcategory', $menu);
	}

	public function editCat ($id)
	{
		if ($this->ModelsForum->SecureCat($id) === true) {
			$menu[] = array('Accueil'=> array('href'=>'/Forum?management&pages','icon'=>'fa fa-home'));
			$data['groups'] = BelCMSConfig::getGroups();
			$data['data']   = $this->ModelsForum->GetForum($id);
			$this->set($data);
			$this->render('editcategory', $menu);			
		} else {
			$this->error(get_class($this), NO_ACCESS_CAT, 'error');
			Common::Redirect('Forum/category?management&pages', 2);
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
		Common::Redirect('Forum/category?management&pages', 2);
	}

	public function addforum ()
	{
		$data['data'] = $this->ModelsForum->GetForum();
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/Forum?management&pages','icon'=>'fa fa-home'));
		$menu[] = array('Configuration'=> array('href'=>'/Forum/parameter?management&pages','icon'=>'fa fa-cubes'));
		$menu[] = array(CATEGORY=> array('href'=>'/Forum/category?management&pages','icon'=>'fa fa-th-large'));
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
				Common::Redirect('Forum/addcategory?management&pages', 2);
				return;
			}
		} elseif ($_POST['send'] == 'editcat') {
			$return = $this->ModelsForum->sendEditCat($_POST);
			Common::Redirect('Forum/category?management&pages', 2);
			$this->error(get_class($this), $return['text'], $return['type']);
			return;
		}

		$this->error(get_class($this), $return['text'], $return['type']);

		Common::Redirect('Forum?management&pages=true', 2);
	}

	public function delForum ($id)
	{
		$return = $this->ModelsForum->delThreads($id);
		$this->error(get_class($this), $return['text'], $return['type']);
		Common::Redirect('Forum?management&pages', 2);
	}

	public function parameter ()
	{
		$data['groups'] = BelCMSConfig::getGroups();
		$data['config'] = BelCMSConfig::GetConfigPage(get_class($this));
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'/Forum?management&pages','icon'=>'fa fa-home'));
		$menu[] = array('Configuration'=> array('href'=>'/Forum/parameter?management&pages','icon'=>'fa fa-cubes'));
		$menu[] = array(CATEGORY=> array('href'=>'/Forum/category?management&pages','icon'=>'fa fa-th-large'));
		$menu[] = array(ADD=> array('href'=>'/Forum/AddForum?management&pages','icon'=>'fa fa-plus'));
		$this->render('parameter', $menu);
	}

	public function sendparameter ()
	{
		$return = $this->ModelsForum->sendparameter($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('Forum?management&pagess', 2);
	}
}