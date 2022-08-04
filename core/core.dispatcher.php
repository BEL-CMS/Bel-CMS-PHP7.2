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

class Dispatcher
{
	var $controller;
	var $view;
	var $links;

	function __construct ()
	{
		$this->links        = isset($_GET['params']) && !empty($_GET['params']) ? explode('/', strtolower(rtrim($_GET['params'], '/'))) : array();
		$this->controller   = self::controller();
		$this->view         = isset($this->links[1]) && !empty($this->links[1]) ? $this->links[1] : 'index';
		$this->id           = self::RequestId();
		$this->IsJquery     = self::IsJquery();
		$this->IsEcho       = self::IsEcho();
		$this->IsJson       = self::IsJson();
		$this->isManagement = self::isManagement();
	}

	private function isManagement()
	{
		$management = false;

		$getManagement = array(
			'admin',
			'Admin',
			'Management',
			'management'
		);
		foreach ($getManagement as $k) {
			if (array_key_exists($k, $_REQUEST)) {
				$management = true;
				break;
			}
		}

		return $management;
	}

	private function controller ()
	{
		if (self::isManagement() === true) {
			if (empty($this->links[0])) {
				$return = 'dashboard';
			} else {
				$return = $this->links[0];
			}
		} else {
			if (isset($this->links[0]) && !empty($this->links[0])) {
				$unauthorized = strtolower($this->links[0]);
				switch ($unauthorized) {
					case 'config':
						return false;
					break;

					case 'asset':
						return false;
					break;

					case 'class':
						return false;
					break;

					case 'pages':
						return false;
					break;

					case 'templates':
						return false;
					break;

					case 'uploads':
						return false;
					break;

					case 'widgets':
						return false;
					break;

					case 'home':
						$return = 'blog';
					break;

					case 'index.html':
						$return = 'blog';
					break;

					case 'index.php':
						$return = 'blog';
					break;

					case 'forum.html':
						$return = 'forum';
					break;

					case 'downloads.html':
						$return = 'downloads';
					break;

					case 'telechargement.html':
						$return = 'downloads';
					break;

					case 'user.html':
						$return = 'user';
					break;

					case 'utilisateur.html':
						$return = 'user';
					break;

					case 'members.html':
						$return = 'members';
					break;

					default:
						$return = $this->links[0];
					break;
				}
			} else {
				$return = 'articles';
			}
		}

		Common::Constant('CURENT_PAGE', $return);

		return $return;
	}

	#########################################
	# Set page
	#########################################
	public static function RequestPages ()
	{
		if (isset($_GET['page']) AND is_numeric($_GET['page']) ) {
			$return = intval($_GET['page']);
		} else {
			$return = 1;
		}
		return $return;
	}

	function IsJquery ()
	{
		$return = false;
		if (isset($_GET['jquery'])) {
			$return = true;
		} else if (isset($_GET['ajax'])) {
			$return = true;
		}
		return $return;
	}

	function IsJson ()
	{
		$return = false;
		if (isset($_GET['json'])) {
			$return = true;
		}
		return $return;
	}

	function IsEcho ()
	{
		$return = false;
		if (isset($_GET['echo'])) {
			$return = true;
		}
		return $return;
	}

	function RequestId ()
	{
		return isset($this->links[2]) && !empty($this->links[2]) ? $this->links[2] : false;
	}
}
