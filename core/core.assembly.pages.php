<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.1.0
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit('<!doctype html><html><head><meta charset="utf-8"><title>BEL-CMS : Error 403 Forbidden</title><style>h1{margin: 20px auto;text-align:center;color: red;}p{text-align:center;font-weight:bold;</style></head><body><h1>HTTP Error 403 : Forbidden</h1><p>You don\'t permission to access / on this server.</p></body></html>');
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
			} else {
				Notification::error('La page demander, n\'est pas disponible.', 'Page no found');
				$buffer = ob_get_contents();
			}
		} else {
			Notification::error('La page demander, n\'est pas disponible.', 'Page no found');
			$buffer = ob_get_contents();
		}

		$this->render = $buffer;

		if (ob_get_length() != 0) {
			ob_end_clean();
		}
	}

	private function getLangs ()
	{
		if (is_file(DIR_PAGES.$this->controller.DS.'lang'.DS.'lang.'.CMS_WEBSITE_LANG.'.php')) {
			require DIR_PAGES.$this->controller.DS.'lang'.DS.'lang.'.CMS_WEBSITE_LANG.'.php';
		}
	}
}