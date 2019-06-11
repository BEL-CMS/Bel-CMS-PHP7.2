<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.3
 * @link http://www.bel-cms.be
 * @link http://www.stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2016 Bel-CMS
 * @author Stive - mail@stive.eu
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class WidgetShoutbox extends Widgets
{
	var $models = array('ModelsShoutbox');

	public function index()
	{
		$d = array();
		$d['shoutbox'] = $this->ModelsShoutbox->getMsg();
		$this->set($d);
		$this->render('index');
	}
}
