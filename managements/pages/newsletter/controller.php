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

class Newsletter extends AdminPages
{
	var $admin  = true; // Admin suprême uniquement (Groupe 1);
	var $active = true; // activation manuel;
	var $models = array('ModelsNewsletter');

	public function index ()
	{
		$this->render('index');
	}

	public function tpl ()
	{
		$set['data'] = $this->ModelsNewsletter->getAllTpl();
		$this->set($set);
		$this->render('templates');
	}

	public function addtpl ()
	{
		$this->render('addtemplate');
	}

	public function sendnewtpl ()
	{
		$return = $this->ModelsNewsletter->addnewtpl($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('newsletter/tpl?management&page=true', 2);
	}
}