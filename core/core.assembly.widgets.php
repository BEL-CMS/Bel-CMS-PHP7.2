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
	var $widgets = null;
	
	function __construct($pos)
	{
		$this->position = $pos;

		if (defined('CMS_TPL_WEBSITE') && !empty(constant('CMS_TPL_WEBSITE')) ) {
			$this->dirTpl = DIR_TPL.CMS_TPL_WEBSITE;
		} else {
			$this->dirTpl = DIR_TPL_DEFAULT;
		}
		self::getWidgets ();
	}

	public function getWidgets ()
	{
		ob_start();

		foreach (self::getWidgetsBDD () as $k => $v) {
			if (is_file($this->dirTpl.'widgets.'.$this->position.'.tpl')) {
				$dirController = DIR_WIDGETS.$v->name.DS.'controller.php';
				if (is_file($dirController)) {
					require $dirController;
				} else {
					Notification::error('Manque le fichier controller du widget'.$name, 'Alert !');
				}
				$name  = $v->name;
				$title = $v->title;
				$this->controller = 'Widget'.ucfirst($name);
				$objWidget = new $this->controller ();
				debug($objWidget);
				$content = $objWidget->widgets;
				require $this->dirTpl.'widgets.'.$this->position.'.tpl';
				$this->widgets .= ob_get_contents ();
				if (ob_get_length () != 0) {
					ob_end_clean ();
				}
			}			
		}
	}

	private function getWidgetsBDD ()
	{
		$return = null;
		$sql = New BDD();
		$sql->table('TABLE_WIDGETS');
		$sql->orderby(array(array('name' => 'orderby', 'type' => 'ASC')));
		$where[] = array('name' => 'pos', 'value' => $this->position);
		$where[] = array('name' => 'activate', 'value' => 1);
		$sql->where($where);
		$sql->queryAll();
		if (!empty($sql->data)) {
			$return = $sql->data;
		}
		return $return;
	}
}
