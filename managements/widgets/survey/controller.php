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

class Survey extends AdminPages
{
	var $active    = true;
	var $models    = array('ModelsSurvey');

	public function index ()
	{
		$set['data'] = $this->ModelsSurvey->getAllSurvey();
		$set['count'] = count($set['data']);
		$this->set($set);
		$this->render('index');
	}

	public function add ()
	{
		$this->render('add');
	}

	public function send ()
	{
		$return = $this->ModelsSurvey->send($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('survey?management&widgets=true', 2);
	}

	public function delete ($id)
	{
		$id = (int) $id;
	}

	public function parameter ()
	{
		
	}
}