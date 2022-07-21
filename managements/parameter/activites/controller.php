<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link https://bel-cms.be
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2014-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class activites extends AdminPages
{
	var $active = true;
	var $models = array('Modelsactivites');

	public function index ()
	{
		$d['data'] = $this->Modelsactivites->interaction();
		$this->set($d);
		$this->render('index');
	}
}