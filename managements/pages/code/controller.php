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

class Code extends AdminPages
{
	var $active = true;
	var $models = array('ModelsCode');

	public function index ()
	{
		$data['data'] = $this->ModelsCode->get();
		$this->set($data);
		$this->render('index');
	}

	public function add ()
	{
		$this->render('add');
	}

	public function sendadd ()
	{
		$return = $this->ModelsCode->insert($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('Code?management&page=true', 2);
	}

	public function edit ()
	{
		
	}
}