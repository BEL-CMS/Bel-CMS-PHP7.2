<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.1
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

final class BelCMS extends Dispatcher
{
	public $render = null;

	function __construct ()
	{
#########################################
# Constructeur
#########################################
		parent::__construct();
#########################################
# Nouveau utilisateurs mise à jour
#########################################
		if ($this->controller != 'shoutbox') {
			new Visitors;
		}

		new BelCMSConfig;
		new Users;

		$sql = New BDD;
		$sql->table('TABLE_MAINTENANCE');
		$sql->queryAll();
		$mtn = $sql->data;
		$mtance = array();
		foreach ($mtn as $k => $v) {
			$mtance[$v->name] = $v->value;
		}

		if ($mtance['status'] == 'close') {
			if (Users::isSuperAdmin($_SESSION['USER']['HASH_KEY'])) {
				Notification::warning('Le site web est en mode fermé, seuls les administrateurs suprêmes ont accès.');
			} else {
				if ($this->controller != 'user') {
					require_once DIR_TPL_DEFAULT.'close/index.php';
					die();
				}
			}
		}
		$ban = New _Ban;
		$ban = $ban->effective();
		if ($ban == false) {
			echo Notification::renderFull('error', 'Vous êtes actuellement banni(e) de ce site', 'Bannissement');
			die();
		}
	}

	public function _init ()
	{
		ob_start();

		if ($this->isManagement === true) {
			require_once MANAGEMENTS.'managements.php';
			new Managements;
		} else if ($this->IsEcho === true) {
			header('Content-Type: text/html');
			$assemblyPage = new AssemblyPages ();
			$assemblyPage->getRender ();
			echo $assemblyPage->render;
		} else if ($this->IsJson === true) {
			header('Content-Type: application/json');
			$assemblyPage = new AssemblyPages ();
			$assemblyPage->getRender ();
			echo ($assemblyPage->render);
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