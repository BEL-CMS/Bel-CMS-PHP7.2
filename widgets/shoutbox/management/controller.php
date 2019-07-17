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

class ControllerManagementShoutbox extends ModelsManagementShoutobx
{
	public 	$data,
			$view,
			$error = null;

	public function index ()
	{
		$this->data = parent::getMsg();
	}

	public function edit ()
	{
		$this->data = parent::getMsg(GET_ID);
	}

	public function send ()
	{
		$this->data = parent::sendEditMsg(GET_ID, $_REQUEST['msg']);
		Common::Redirect('shoutbox?Management', 2);
	}

	public function del ()
	{
		$return = parent::DelMsg(GET_ID);
		$this->data = $return;
		Common::Redirect('Shoutbox?management', 2);
	}
}
