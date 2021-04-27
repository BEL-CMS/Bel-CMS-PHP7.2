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

class Maintenance extends AdminPages
{
	var $admin     = true; // Admin suprême uniquement (Groupe 1);
	var $active    = true;
	var $models    = array('ModelsMaintenance');

	public function index ()
	{
		$data['data'] = $this->ModelsMaintenance->getMaintenance();
		$this->set($data);
		$menu[] = array('Accueil'=> array('href'=>'maintenance?management&parameter=true','icon'=>'fa fa-home'));
		$this->render('index', $menu);
	}

	public function sendpostOpen ()
	{
		$return = $this->ModelsMaintenance->openClose($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('maintenance?management&parameter=true', 0);
	}

	public function sendpost ()
	{
		$return = $this->ModelsMaintenance->sendpost($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('maintenance?management&parameter=true', 2);
	}

}