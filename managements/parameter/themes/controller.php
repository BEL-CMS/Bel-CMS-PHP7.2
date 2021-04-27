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

class Themes extends AdminPages
{
	var $admin     = true; // Admin suprême uniquement (Groupe 1);
	var $active    = true;
	var $models    = array('ModelsThemes');

	public function index ()
	{
		$data['active'] = $this->ModelsThemes->getTplActive();
		$data['tpl'] = $this->ModelsThemes->getTpl();
		$this->set($data);
		$this->render('index');
	}
	public function send ()
	{
		$return = $this->ModelsThemes->sendTpl($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('themes?management&parameter=true', 2);
	}
}