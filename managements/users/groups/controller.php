<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2022 Bel-CMS
 * @author Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class Groups extends AdminPages
{
	var $admin  = true; // Admin suprême uniquement (Groupe 1);
	var $active = true; // activation manuel;
	var $models = array('ModelGroups');

	function __construct() {
		if ($this->active == false) {
			Notification::error('Page fermer manuellement');
		}
	}

	public function index ()
	{
		$menu[] = array('Accueil'=> array('href'=>'/groups?management&users','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'/groups/add?management&users','icon'=>'fa fa-plus'));
		$this->render('index', $menu);
	}

	public function add ()
	{
		$menu[] = array('Accueil'=> array('href'=>'groups?management&users','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'/groups/add?management&users','icon'=>'fa fa-plus'));
		$this->render('new', $menu);
	}

	public function sendnew ()
	{
		$return = $this->ModelGroups->sendnew($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/groups?management&users', '2');
	}

	public function detele ($id)
	{
		$id = (int) $id;
		if ($id == 1 or $id == 2) {
			$this->error(get_class($this), 'Impossible de supprimer ce groupe', 'error');
			$this->redirect('/groups?management&users', '1');
		} else {
			$return = $this->ModelGroups->delete($id);
			$this->error(get_class($this), $return['text'], $return['type']);
			$this->redirect('/groups?management&users', '1');
			return $return;	
		}
	}

	public function edit ($id)
	{
		$id = (int) $id;
		$data['data'] = $this->ModelGroups->edit($id);
		$this->set($data);
		$this->render('edit');
	}

	public function sendedit ()
	{
		if (isset($POST['id']) and $_POST == 1 or isset($POST['id']) and $_POST == 2) {
			$this->error(get_class($this), 'Impossible d\'editer ce groupe', 'warning');
			$return = $this->ModelGroups->sendedit($_POST);
			$this->redirect('/groups?management&users', '1');
		} else {
			$return = $this->ModelGroups->sendedit($_POST);
			$this->error(get_class($this), $return['text'], $return['type']);
			$this->redirect('/groups?management&users', '1');
		}
		return $return;
	}
}