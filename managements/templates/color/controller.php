<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
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

class Color extends AdminPages
{
	var $admin  = true; // Admin suprême uniquement (Groupe 1);
	var $active = true; // activation manuel;
	var $models = array('ModelsColor');

	public function index ()
	{
		$menu[] = array('Accueil'=> array('href'=>'/color?management&templates','icon'=>'fa fa-home'));
		$menu[] = array('Editer'=> array('href'=>'/color/add?management&templates','icon'=>'fa fa-plus'));
		$this->render('index', $menu);
	}

	public function add ()
	{
		$menu[] = array('Accueil'=> array('href'=>'/color?management&templates','icon'=>'fa fa-home'));
		$this->render('add', $menu);
	}

	public function sendadd ()
	{
		$return = $this->ModelsColor->editColor($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/color?management&templates', '2');
	}
}