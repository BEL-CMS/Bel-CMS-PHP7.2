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

class Team extends Pages
{
	var $models = array('ModelsTeam');

	public function index ()
	{
		$set['data'] = $this->ModelsTeam->getTeam();
		if (empty($set['data'])) {
			Notification::warning('Aucune Team enregistrer');
		} else {
			$this->set($set);
			$this->render('index');
		}
	}
}