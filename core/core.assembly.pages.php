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

final class AssemblyPages extends Dispatcher
{
	public $render;

	function __construct ()
	{
		parent::__construct();
		self::getLangs ();
	}

	public function getRender ()
	{
		ob_start();

		$dir = DIR_PAGES.$this->controller.DS.'controller.php';

		if (is_file($dir)) {
			require $dir;
			$this->controller = new $this->controller();
			if (method_exists($this->controller, $this->view)) {
				unset($this->links[0], $this->links[1]);
				call_user_func_array(array($this->controller,$this->view),$this->links);
				echo $this->controller->page;
				$buffer = ob_get_contents();
			}
		} else {
			Notification::error('file controller and view no found', 'Page no found');
			$buffer = ob_get_contents();
		}

		if (ob_get_length() != 0) {
			ob_end_clean();
		}

		$this->render = $buffer;
	}

	private function getLangs ()
	{
		if (is_file(DIR_PAGES.$this->controller.DS.'lang'.DS.'lang.'.CMS_WEBSITE_LANG.'.php')) {
			require DIR_PAGES.$this->controller.DS.'lang'.DS.'lang.'.CMS_WEBSITE_LANG.'.php';
		}
	}
}