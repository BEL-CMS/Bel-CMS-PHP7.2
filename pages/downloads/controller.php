<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.1
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

class Downloads extends Pages
{
	var $models = array('ModelsDownloads');

	public function index ()
	{	
		$c['data'] = $this->ModelsDownloads->getCat();
		foreach ($c['data'] as $a => $b) {
			if (Secures::isAcess($b->groups) == false) {
				unset($c['data'][$a]);
			} else {
				$c['data'][$a]->count = $this->ModelsDownloads->countFiles($b->id);
			}
			
		}
		$this->set($c);
		$this->render('index');
	}

	public function category ($id = null)
	{
		$a = $this->ModelsDownloads->getCat($id);
		$c['name'] = $a->name;
		if (Secures::isAcess($a->groups) == true) {
			$c['data'] = $this->ModelsDownloads->getDls($id);
		} else {
			$c['data'] = array();
		}
		$this->set($c);
		$this->render('category');
	}

	public function detail ($id = null)
	{
		$c['data'] = current($this->ModelsDownloads->getDlsDetail($id));
		if (empty($c['data'])) {
			$this->error(INFO, 'ID non valide', 'warning');
		} else {
			$this->ModelsDownloads->NewView($id);
			$this->set($c);
			$this->render('detail');			
		}
	}

	public function getDl ($id)
	{
		if ($id != null && is_numeric($id)) {
			if ($this->ModelsDownloads->ifAccess($id) == true) {
				$this->redirect($this->ModelsDownloads->getDownloads($id), 0);
				$c['data'] = current($this->ModelsDownloads->getDlsDetail($id));
				$this->set($c);
				$this->render('detail');
			} else {
				$this->error(INFO, 'NO DL', 'warning');
			}
		}
	}
}
