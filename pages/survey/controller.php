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

class Survey extends Pages
{
	var $models = array('ModelsSurvey');

	public function index ()
	{

	}

	public function send ()
	{
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$return = $this->ModelsSurvey->addVote($_POST);
			$this->error(get_class($this), $return['text'], $return['type']);
			$this->redirect('blog', 2);
		} else {
			$this->error(get_class($this), ERROR_NO_ID_VALID, 'error');
		}
	}
}