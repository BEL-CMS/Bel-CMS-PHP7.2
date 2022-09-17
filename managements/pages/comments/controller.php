<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.2
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit('<!doctype html><html><head><meta charset="utf-8"><title>BEL-CMS : Error 403 Forbidden</title><style>h1{margin: 20px auto;text-align:center;color: red;}p{text-align:center;font-weight:bold;</style></head><body><h1>HTTP Error 403 : Forbidden</h1><p>You don\'t permission to access / on this server.</p></body></html>');
}

class Comments extends AdminPages
{
	var $admin  = true; // Admin suprême uniquement (Groupe 1);
	var $active = true;
	var $models = array('ModelsComments');

	public function index ()
	{

		$var = $this->ModelsComments->getAllComments();
		if (!empty($var)):
			$data['comments'] = $var;
		else:
			$data['comments'] = null;
		endif;
		$this->set($data);
		$this->render('index');
	}

	public function edit ($id)
	{
		$data['comments'] = $this->ModelsComments->getComment($id);
		$this->set($data);
		$this->render('edit');
	}

	public function sendedit ()
	{
		$return = $this->ModelsComments->sendedit($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/comments?management&pages', 2);
	}

	public function del ($id)
	{
		$return = $this->ModelsComments->del($id);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/comments?management&pages', 2);
	}
}