<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class activate extends AdminPages
{
	var $admin  = true; // Admin suprême uniquement (Groupe 1);
	var $active = true; // activation manuel;
	var $models = array('ModelsActivate');

	public function index ()
	{
		$d['pages']   = $this->ModelsActivate->getNamePages();
		$d['widgets'] = $this->ModelsActivate->getNameWidgets();
		$this->set($d);
		$this->render('index');
	}

	public function sendAddPages ()
	{
		$return = $this->ModelsActivate->sendBDDPages ($_POST);
		$this->error(get_class($this), $return['msg'], $return['type']);
		$this->redirect('activate?management&parameter', 2);
	}
	public function sendAddWidgets ()
	{
		$return = $this->ModelsActivate->sendBDDWidgets ($_POST);
		$this->error(get_class($this), $return['msg'], $return['type']);
		$this->redirect('activate?management&parameter', 2);
	}
}