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

class Downloads extends Pages
{
	var $models = array('ModelsDownloads');

	public function index ()
	{	
		$data = $this->ModelsDownloads->getCat();
		foreach ($data as $a => $b) {
			if (Secures::isAcess($b->groups) == false) {
				unset($c['data'][$a]);
			} else {
				$get['data'][$a]->name = $b->name;
				$get['data'][$a]->id   = $b->id;
				$get['data'][$a]->dl   = $this->ModelsDownloads->getDls($b->id);
			}
		}
		$this->set($get);
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
				if (stristr($this->ModelsDownloads->getDownloads($id), 'http') === true or stristr($this->ModelsDownloads->getDownloads($id), 'https')) {
					$this->link($this->ModelsDownloads->getDownloads($id), 0);
				} else {
					$this->redirect($this->ModelsDownloads->getDownloads($id), 0);
				}
				$this->error(INFO, 'Téléchargement en cours', 'success');
				$c['data'] = current($this->ModelsDownloads->getDlsDetail($id));
				$this->set($c);
				$this->render('detail');
			} else {
				$this->error(INFO, 'NO DL', 'warning');
			}
		}
	}
}
