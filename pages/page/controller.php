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
	private $php = true;

	public function index ($page = false)
	{
		if (!empty($page) && $this->ModelsPage->TestExistPage($page) === true) {
			$data['title']   = Common::MakeConstant($page);
			$data['content'] = $this->ModelsPage->GetPage($page, $this->php)->content;
			$this->set($data);
			$this->render('index');
		} else {
			$this->error(INFO, 'La page demander n\'existe pas !', 'warning');
		}
	}

	public function subPage ($name = null)
	{
		$page = Common::ScanFiles(ROOT.'pages/page/sub-page');
		if (!empty($page)) {
			$page = str_replace(".php", "", $page);
		}
		$full = Common::ScanFiles(ROOT.'pages/page/sub-page', true, true);
		if (in_array(strtolower($name), $page)) {
			require_once(ROOT.'pages/page/sub-page'.DS.$name.'.php');
		} else {
			$this->error(INFO, 'La page ('.$name.') demander n\'existe pas !', 'warning');
		}
	}
}
