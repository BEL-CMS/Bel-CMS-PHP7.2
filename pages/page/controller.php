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

class Page extends Pages
{
	var $models  = array('ModelsPage');

	public function index ($page = false)
	{	
		$set['data'] = $this->ModelsPage->getPage();
		foreach ($set['data'] as $k => $v) {
			if (Secures::IsAcess($v->groups) == false) {
				unset($set['data'][$k]);
			}
		}
		$page = Common::ScanFiles(ROOT.'pages/page/sub-page');
		if (!empty($page)) {
			$set['sub'] = str_replace(".php", "", $page);
		}
		$this->set($set);
		$this->render('index');
	}

	public function read ($id = null)
	{
		if (!is_null($id) && is_numeric($id)) {
			$set['data'] = $this->ModelsPage->getPageContentId($id);
			$get = $this->ModelsPage->getPageId($set['data']->number);
			if (Secures::IsAcess($get->groups) == false) {
				$this->error(get_class($this), NO_ACCESS_GROUP_PAGE, 'error');
			} else {
				$this->set($set);
				$this->render('read');	
			}
		} else {
			$this->error(get_class($this), 'Aucun ID', 'warning');
		}
	}

	public function subpage ($id)
	{
		if (!is_null($id) && is_numeric($id)) {
			$set['data'] = $this->ModelsPage->getPages($id);
			if (empty($set['data'])) {
				Notification::warning('Aucune page dans la BDD');
			} else {
				$get = $this->ModelsPage->getPageId(current($set['data'])->number);
				if (Secures::IsAcess($get->groups) == false) {
					$this->error(get_class($this), NO_ACCESS_GROUP_PAGE, 'error');
				} else {
					$this->set($set);
					$this->render('subpage');
				}
			}
		} else {
			$this->error(get_class($this), 'Aucun ID', 'warning');
		}
	}

	public function intern ($name = null)
	{
		$page = Common::ScanFiles(ROOT.'pages/page/sub-page');
		if (!empty($page)) {
			$page = str_replace(".php", "", $page);
		}
		$full = Common::ScanFiles(ROOT.'pages/page/sub-page', true, true);
		if (in_array(strtolower($name), $page)) {
			require_once(ROOT.'pages/page/sub-page'.DS.$name.'.php');
		} else {
			$this->error(get_class($this), 'La page ('.$name.') demander n\'existe pas !', 'warning');
		}
	}
}
