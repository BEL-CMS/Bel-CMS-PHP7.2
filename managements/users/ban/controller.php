<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.1
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

class Ban extends AdminPages
{
	var $admin  = true; // Admin suprême uniquement (Groupe 1);
	var $active = true; // activation manuel;
	var $models = array('ModelsBan');

	public function index ()
	{
		$menu[] = array('Accueil'=> array('href'=>'/ban?management&users','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'=> array('href'=>'/ban/add?management&users','icon'=>'fa fa-plus'));
		$data['ban'] = $this->ModelsBan->getUsersBan();
		$this->set($data);
		$this->render('index', $menu);
	}

	public function add ()
	{
		$data['key']    = $this->ModelsBan->getKey();
		$data['author'] = $this->ModelsBan->getUsers();
		$menu[]         = array('Accueil'=> array('href'=>'/ban?management&users','icon'=>'fa fa-home'));
		$this->set($data);
		$this->render('add', $menu);
	}

	public function sendadd ()
	{
		$return = $this->ModelsBan->sendadd($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('ban?management&users', 3);
	}

	public function del ($hash_key)
	{
		$return = $this->ModelsBan->del($hash_key);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('ban?management&users', 3);

	}
}