<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.2
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

final class Managements extends Dispatcher
{
	public  $render;

	#########################################
	# redirige l'utilisateur si loguer ou pas
	#########################################
	function __construct()
	{
		parent::__construct ();

		self::getLangs();

		if (isset($_SESSION['USER']['HASH_KEY']) && strlen($_SESSION['USER']['HASH_KEY']) == 32) {
			if (isset($_SESSION['LOGIN_MANAGEMENT']) and $_SESSION['LOGIN_MANAGEMENT'] === true) {
				require_once MANAGEMENTS.'intern'.DS.'adminpages.php';
				self::base();
			} else {
				self::login();
			}
		} else {
			Common::Redirect('User/Login');
		}
	}
	#########################################
	# Page principal avec le menu
	#########################################
	public function base ()
	{
		$render        = self::getLinksPages ($this->controller);
		$menuPage      = self::menuPage ();
		$menuWidget    = self::menuWidget ();
		$menuGaming    = self::menuGaming ();
		$menuParameter = self::menuParameter ();
		$menuTemplates = self::menuTemplates ();
		$menuUsers     = self::menuUsers ();
		require_once MANAGEMENTS.'intern'.DS.'layout.php';
	}
	#########################################
	# Gestion des pages & widgets + le dashboard
	#########################################
	private function getLinksPages ($page = null)
	{
		$render = null;

		ob_start();

		$groups = Users::getGroups($_SESSION['USER']['HASH_KEY']);

		require_once MANAGEMENTS.'intern'.DS.'adminpages.php';
		#####################################
		# Accessible Uniquement aux administrateurs de 1er niveau
		#####################################
		if (isset($_REQUEST['parameter'])) {
			if ($this->view == strtolower('parameter') or $this->view == strtolower('sendparameter') or $page == strtolower('parameter') or strtolower(isset($_REQUEST['parameter']))) {
				if (!in_array(1, $groups)) {
					?>
					<div id="page-content">
					<?php
					Notification::error(NO_ACCESS_GROUP_PAGE, 'Page');
					?>
					</div>
					<?php
					$render = ob_get_contents();
					if (ob_get_length() != 0) {
						ob_end_clean();
					}
					$page = defined(strtoupper($page)) ? constant(strtoupper($page)) : $page;
					$Interaction = New Interaction;
					$Interaction->user($_SESSION['USER']['HASH_KEY']);
					$Interaction->title('Accès non autorisé');
					$Interaction->type('error');
					$Interaction->text('Accès non autorisé de '.Users::hashkeyToUsernameAvatar($_SESSION['USER']['HASH_KEY']).' à la page '.$page.' : paramètre');
					$Interaction->insert();
					return $render;
				}
			}
		}
		#####################################
		# End
		#####################################
		# requete page
		if (isset($_REQUEST['pages'])) {
			echo self::request('pages', $page);
		} else if (isset($_REQUEST['templates'])) {
			echo self::request('templates', $page);
		} else if (isset($_REQUEST['users'])) {
			echo self::request('users', $page);
		} else if (isset($_REQUEST['widgets'])) {
			echo self::request('widgets', $page);
		} else if (isset($_REQUEST['gaming'])) {
			echo self::request('gaming', $page);
		} else if (isset($_REQUEST['parameter'])) {
			echo self::request('parameter', $page);
		} else {
			include MANAGEMENTS.'intern'.DS.'dashboard.php';
			$render = ob_get_contents();
		}
		#####################################
		# end requete page
		#####################################
		# Mise en mémoire tempon
		#####################################
		$render = ob_get_contents();
		#####################################
		# reset le tempon
		#####################################
		if (ob_get_length() != 0) {
			ob_end_clean();
		}
		#####################################
		# Retourne le rendu de la page
		#####################################
		return $render;
	}
	#########################################
	# Requete des pages = menu
	#########################################
	private function request ($request, $page) {
		$scan  = Common::ScanDirectory(MANAGEMENTS.$request);
		if (in_array($page, $scan)) {
			if (Secures::getAccessPageAdmin($page) === false) {
			?>
				<div id="page-content">
			<?php
				Notification::error(NO_ACCESS_GROUP_PAGE, 'Page');
			?>
				</div>
			<?php
				$page = defined(strtoupper($page)) ? constant(strtoupper($page)) : $page;
				$Interaction = New Interaction;
				$Interaction->user($_SESSION['USER']['HASH_KEY']);
				$Interaction->title('Accès non autorisé');
				$Interaction->type('error');
				$Interaction->text('Accès non autorisé de '.Users::hashkeyToUsernameAvatar($_SESSION['USER']['HASH_KEY']).' à la page '.$page.' : paramètre');
				$Interaction->insert();
			} else {
				$require = MANAGEMENTS.$request.DS.$page.DS.'controller.php';
				if(!is_file($require)) {
					Notification::error('Accès au controller impossible <br> '.$require, 'Page', true);
					die();
				}
				require_once $require;
				$this->controller = new $this->controller();
				if ($this->controller->active === true) {
					if (method_exists($this->controller, $this->view)) {
						unset($this->links[0], $this->links[1]);
						call_user_func_array(array($this->controller,$this->view),$this->links);
					} else {
					?>
					<div id="page-content">
					<?php
						Notification::error('La sous-page demander <strong>'.$this->view.'</strong> n\'est pas disponible dans la page <strong>'.$page.'</strong>', 'Fichier');
							?>
					</div>
					<?php
					}
					echo $this->controller->render;
				}
			}
		} else {

		}
	}
	#########################################
	# Page Login
	#########################################
	private function login ()
	{
		if (isset($_REQUEST['umal']) && isset($_REQUEST['passwrd'])) {
			if (!empty($_REQUEST['umal']) && !empty($_REQUEST['passwrd'])) {

				if (Secure::isMail($_REQUEST['umal']) === false) {
					$return['ajax'] = 'Veuillez entrer votre e-mail';
					echo json_encode($return);
					sleep(1);
					return;
				}

				$return = array();

				$sql = New BDD();
				$sql->table('TABLE_USERS');
				$sql->where(array('name' => 'email', 'value' => $_REQUEST['umal']));
				$sql->queryOne();
				$data = $sql->data;

				if (password_verify($_REQUEST['passwrd'], $data->password)) {
					if ($_SESSION['USER']['HASH_KEY'] == $data->hash_key) {
						$Interaction = New Interaction;
						$Interaction->user($_SESSION['USER']['HASH_KEY']);
						$Interaction->type('success');
						$Interaction->title('Accès autorisé');
						$Interaction->text('S\'est connecté au management');
						$Interaction->insert();
						$_SESSION['LOGIN_MANAGEMENT'] = true;
						$return['ajax'] = 'login en cours...';
					} else {
						$Interaction = New Interaction;
						$Interaction->user($_SESSION['USER']['HASH_KEY']);
						$Interaction->type('error');
						$Interaction->title('Accès non autorisé');
						$Interaction->text('À tenter de ce connecté avec un autre Hash Key !');
						$Interaction->insert();
						$return['ajax'] = 'Hash_key ne corespond pas au votre ?...';
					}
				} else {
					$Interaction = New Interaction;
					$Interaction->user($_SESSION['USER']['HASH_KEY']);
					$Interaction->type('error');
					$Interaction->title('Accès non autorisé');
					$Interaction->text('Tentative d\'accès avec un mauvais mot de passe !');
					$Interaction->insert();
					$return['ajax'] = 'Le password n\'est pas le bon !!!';
				}

				sleep(1);

				echo json_encode($return);
			}
		} else {
			include MANAGEMENTS.'intern/login.php';
		}
	}
	#########################################
	# Menu des pages
	#########################################
	private function menuPage ()
	{
		$pages  = self::getPages ();
		$return = array();

		foreach ($pages as $k => $v) {
			$return['/'.$v.'?management&pages'] = defined(strtoupper($v)) ? constant(strtoupper($v)) : $v;
		}
		return $return;
	}
	#########################################
	# Menu des Widgets
	#########################################
	private function menuWidget ()
	{
		$widgets  = self::getWidgets ();
		$return   = array();

		foreach ($widgets as $k => $v) {
			$return['/'.$v.'?management&widgets'] = defined(strtoupper($v)) ? constant(strtoupper($v)) : $v;
		}
		return $return;
	}
	#########################################
	# Menu des Widgets
	#########################################
	private function menuTemplates ()
	{
		$templates = self::getTemplates ();
		$return    = array();

		foreach ($templates as $k => $v) {
			$return['/'.$v.'?management&templates'] = defined(strtoupper($v)) ? constant(strtoupper($v)) : $v;
		}
		return $return;
	}
	#########################################
	# Menu Utilisateurs
	#########################################
	private function menuUsers ()
	{
		$users  = self::getUsers ();
		$return = array();

		foreach ($users as $k => $v) {
			$return['/'.$v.'?management&users'] = defined(strtoupper($v)) ? constant(strtoupper($v)) : $v;
		}
		return $return;
	}
	#########################################
	# Menu gaming
	#########################################
	private function menuGaming ()
	{
		$gaming  = self::getGaming ();
		$return  = array();

		foreach ($gaming as $k => $v) {
			$return['/'.$v.'?management&gaming'] = defined(strtoupper($v)) ? constant(strtoupper($v)) : $v;
		}
		return $return;
	}
	#########################################
	# Menu parameter
	#########################################
	private function menuParameter ()
	{
		$parameter  = self::getParameter ();
		$return     = array();

		foreach ($parameter as $k => $v) {
			$return['/'.$v.'?management&parameter'] = defined(strtoupper($v)) ? constant(strtoupper($v)) : $v;
		}
		return $return;
	}
	#########################################
	# Scan le dossier des pages
	#########################################
	private function getPages ()
	{
		$scan = Common::ScanDirectory(MANAGEMENTS.'pages', true);
		asort($scan);
		return $scan;
	}
	#########################################
	# Scan le dossier des widgets
	#########################################
	private function getWidgets ()
	{
		$scan = Common::ScanDirectory(MANAGEMENTS.'widgets', true);
		asort($scan);
		return $scan;
	}
	#########################################
	# Scan le dossier d'utilisateurs
	#########################################
	private function getUsers ()
	{
		$scan = Common::ScanDirectory(MANAGEMENTS.'users', true);
		asort($scan);
		return $scan;
	}
	#########################################
	# Scan le dossier du templates
	#########################################
	private function getTemplates ()
	{
		$scan = Common::ScanDirectory(MANAGEMENTS.'templates', true);
		asort($scan);
		return $scan;
	}
	#########################################
	# Scan le dossier gaming
	#########################################
	private function getGaming ()
	{
		$scan = Common::ScanDirectory(MANAGEMENTS.'gaming', true);
		asort($scan);
		return $scan;
	}
	#########################################
	# Scan le dossier parameter
	#########################################
	private function getParameter ()
	{
		$scan = Common::ScanDirectory(MANAGEMENTS.'parameter', true);
		asort($scan);
		return $scan;
	}
	#########################################
	# récupère tout les fichiers de lang et les inclus
	#########################################
	private function getLangs ()
	{
		$scan = Common::ScanFiles(MANAGEMENTS.'langs');
		foreach ($scan as $k => $v) {
			require_once MANAGEMENTS.'langs'.DS.$v;
		}
	}
	#########################################
	# Autorisation des pages
	#########################################
	private function security ()
	{
		$sql = New BDD();
		$sql->table('TABLE_USERS');
		$sql->where(array('name' => 'email', 'value' => $_REQUEST['umal']));
		$sql->queryOne();
		$data = $sql->data;
	}
}