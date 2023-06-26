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

class WidgetSurvey extends Widgets
{
	var $models = array('ModelsSurveyWidgets');

	public function index ()
	{	
		$set['data']  = $this->ModelsSurveyWidgets->getLastSurvey();
		if (!empty($set['data'])) {
			$set['count'] = $this->ModelsSurveyWidgets->countVote($set['data']->id);
			$set['vote']  = $this->ModelsSurveyWidgets->getNumberVote($set['data']->id);
		}
		$this->set($set);
		$this->render('index');
	}
}