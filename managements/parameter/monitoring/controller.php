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

class monitoring extends AdminPages
{
	var $active = true;
	var $models = array('ModelsMonitoring');

	public function index ()
	{
		//$d['data'] = $this->ModelsMonitoring->lastInteraction();
		//$this->set($d);
		$menu[] = array('Accueil'=> array('href'=>'prefgen?management&parameter=true','icon'=>'fa fa-home'));
		$this->render('index', $menu);
	}
}