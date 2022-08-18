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

class monitoring extends AdminPages
{
	var $active = true;
	var $models = array('ModelsMonitoring');

	function __construct() {
		if ($this->active == false) {
			Notification::error('Page fermer manuellement');
		}
	}

	public function index ()
	{
		//$d['data'] = $this->ModelsMonitoring->lastInteraction();
		//$this->set($d);
		$menu[] = array('Accueil'=> array('href'=>'prefgen?management&parameter=true','icon'=>'fa fa-home'));
		$this->render('index', $menu);
	}
}