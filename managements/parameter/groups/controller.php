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

class Groups extends AdminPages
{
	var $admin  = true; // Admin suprême uniquement (Groupe 1);
	var $active = true; // activation manuel;
	var $models = array('ModelGroups');

	public function index ()
	{
		$menu[] = array('Accueil'=> array('href'=>'groups?management&parameter=true','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'groups/add?management&parameter=true','icon'=>'fa fa-plus'));
		$this->render('index', $menu);
	}

	public function add ()
	{
		$menu[] = array('Accueil'=> array('href'=>'groups?management&parameter=true','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'groups/add?management&parameter=true','icon'=>'fa fa-plus'));
		$this->render('new', $menu);
	}

	public function sendnew ()
	{
		$return = $this->ModelGroups->sendnew($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('groups?management&parameter=true', '2');
	}

	public function detele ($id)
	{
		$id = (int) $id;
		if ($id == 1 or $id == 2) {
			$this->error(get_class($this), 'Impossible de supprimer ce groupe', 'error');
			$this->redirect('groups?management&parameter=true', '1');
		} else {
			$return = $this->ModelGroups->delete($id);
			$this->error(get_class($this), $return['text'], $return['type']);
			$this->redirect('groups?management&parameter=true', '1');
			return $return;	
		}
	}

	public function edit ($id)
	{
		$id = (int) $id;
		if ($id == 1 or $id == 2) {
			$this->error(get_class($this), 'Impossible d\'editer ce groupe', 'error');
			$this->redirect('groups?management&parameter=true', '1');
		} else {
			$data['data'] = $this->ModelGroups->edit($id);
			$this->set($data);
			$this->render('edit');
		}
	}

	public function sendedit ()
	{
		if (isset($POST['id']) and $_POST == 1 or isset($POST['id']) and $_POST == 2) {
			$this->error(get_class($this), 'Impossible d\'editer ce groupe', 'warning');
			$this->redirect('groups?management&parameter=true', '1');
		} else {
			$return = $this->ModelGroups->sendedit($_POST);
			$this->error(get_class($this), $return['text'], $return['type']);
			$this->redirect('groups?management&parameter=true', '1');
			return $return;	
		}
	}
}