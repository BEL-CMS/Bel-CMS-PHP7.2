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

class WidgetConnected extends Widgets
{
	var $models = array('ModelsConnected');

	public function __construct()
	{
		parent::__construct();
	}


	public function index ()
	{
		/*
		$d = array();
		$d['data'] = $this->data;
		$this->set($d);
		*/
		$this->render('index');
	}
}
