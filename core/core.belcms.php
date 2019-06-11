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

final class BelCMS extends Dispatcher
{
	public $render = null;

	function __construct ()
	{
		parent::__construct();

		if ($this->controller !== 'shoutbox') {
			new Visitors;
		}
		new BelCMSConfig;
		new Users;
	}

	public function _init ()
	{
		ob_start();

		if ($this->isManagement === true) {
			require_once MANAGEMENTS.'managements.php';
			new Managements;
		} else if ($this->IsEcho === true) {
			$assemblyPage = new AssemblyPages ();
			$assemblyPage->getRender ();
			echo $assemblyPage->render;
		} else if ($this->IsJson === true) {
			header('Content-Type: application/json');
			$assemblyPage = new AssemblyPages ();
			$assemblyPage->getRender ();
			echo json_encode($assemblyPage->render);
		} else {
			$template = new Template();
			echo $template->render;			
		}

		$this->render = ob_get_contents();

		if (ob_get_length() != 0) {
			ob_end_clean();
		}
	}
}