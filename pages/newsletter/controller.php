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

class Newsletter extends Pages
{
	var $models = array('ModelsNewsletter');

	public function index ()
	{
		if (isset($_SESSION['USER'])) {
			$grp = Users::getGroups($_SESSION['USER']['HASH_KEY']);
			if (in_array(1, $grp)) {
				$set['data'] = $this->ModelsNewsletter->getuUersList();
				$this->set($set);
				$this->render('index');
			} else {
				$this->error(get_class($this), NO_ACCESS_GROUP_PAGE, 'error');
				$this->redirect('blog', 2);
			}
		} else {
			$this->error(get_class($this), NO_ACCESS_GROUP_PAGE, 'error');
			$this->redirect('blog', 2);
		}
	}

	public function send ()
	{
		if (isset($_SESSION['USER'])) {
			if (Users::isLogged()) {
				$return = $this->ModelsNewsletter->sendNew($_POST);
				$this->error (get_class($this), $return['text'], $return['type']);
				$this->redirect('blog', 2);
			} else {
				$this->error(get_class($this), NO_ACCESS_GROUP_PAGE, 'error');
				$this->redirect('blog', 2);
			}
		} else {
			$this->redirect('blog', 2);
			$this->error(get_class($this), NO_ACCESS_GROUP_PAGE, 'error');
		}
	}
}