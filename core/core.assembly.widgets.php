<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
 * @link https://bel-cms.be
 * @link https://stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2019 Bel-CMS
 * @author Stive - determe@stive.eu
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class assemblyWidgets
{
	public $position;
	var $widget = array();
	
	function __construct($pos)
	{
		$this->position = $pos;

		if (defined('CMS_TPL_WEBSITE') && !empty(constant('CMS_TPL_WEBSITE')) ) {
			$this->dirTpl = DIR_TPL.CMS_TPL_WEBSITE;
		} else {
			$this->dirTpl = DIR_TPL_DEFAULT;
		}
	}

	public function getWidgets ()
	{
		ob_start();

		if (is_file($this->dirTpl.'widgets.'.$this->position.'.tpl')) {
			require $this->dirTpl.'widgets.'.$this->position.'.tpl';
			$widget = ob_get_contents ();
		}
		
		if (ob_get_length () != 0) {
			ob_end_clean ();
		}
		return $widget;
	}

	private function getWidgetsBDD ()
	{
		$return = null;
		$sql = New BDD();
		$sql->table('TABLE_WIDGETS');
		$sql->orderby(array(array('name' => 'orderby', 'type' => 'ASC')));
		$sql->queryAll();
		if (!empty($sql->data)) {
			$return = $sql->data;
		}
		return $return;
	}

	

	
}
