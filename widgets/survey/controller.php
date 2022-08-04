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