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
		$menuPage      = self::menuPage();
		$menuWidget    = self::menuWidget();
		$menuGaming    = self::menuGaming();
		$menuParameter = self::menuParameter();
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

		if ($page == 'dashboard') {
			if (in_array(1, $groups)) {
				include MANAGEMENTS.'intern'.DS.'dashboard.php';
			} else {
						?>
				<div id="page-content">				        
				        	<?php
				Notification::error(NO_ACCESS_GROUP_PAGE, 'Page');
				?></div><?php
			}
			$render = ob_get_contents();
		} else {
			if (isset($_REQUEST['parameter'])) {
				if ($this->view == 'parameter' or $this->view == 'sendparameter' or $page == 'parameter' or $_REQUEST['parameter'] == true) {
					if (!in_array(1, $groups)) {
						?>
						<div id="page-content">

							<ul class="breadcrumb breadcrumb-top">
								<li>Index</li>
							</ul>
						<?php
						Notification::error(NO_ACCESS_GROUP_PAGE, 'Page');
						?></div><?php
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
			if (isset($_REQUEST['page']) and $_REQUEST['page'] == true) {
				$scan = Common::ScanDirectory(MANAGEMENTS.'pages');
				if (in_array($page, $scan)) {
					if (Secures::getAccessPageAdmin($page) === false) {
						?>
						<div id="page-content">

							<ul class="breadcrumb breadcrumb-top">
								<li>Index</li>
							</ul>
						<?php
						Notification::error(NO_ACCESS_GROUP_PAGE, 'Page');
						?></div><?php
						$page = defined(strtoupper($page)) ? constant(strtoupper($page)) : $page;
						$Interaction = New Interaction;
						$Interaction->user($_SESSION['USER']['HASH_KEY']);
						$Interaction->title('Accès non autorisé');
						$Interaction->type('error');
						$Interaction->text('Accès non autorisé de '.Users::hashkeyToUsernameAvatar($_SESSION['USER']['HASH_KEY']).' à la page '.$page.' : paramètre');
						$Interaction->insert();
					} else {
						include MANAGEMENTS.'pages'.DS.$page.DS.'controller.php';
						$this->controller = new $this->controller();
						if ($this->controller->active === true) {
							if (method_exists($this->controller, $this->view)) {
								unset($this->links[0], $this->links[1]);
								call_user_func_array(array($this->controller,$this->view),$this->links);
							} else {
							?>
								<div id="page-content">

									<ul class="breadcrumb breadcrumb-top">
										<li>Index</li>
									</ul>
								<?php
								Notification::error('La sous-page demander <strong>'.$this->view.'</strong> n\'est pas disponible dans la page <strong>'.$page.'</strong>', 'Fichier');
								?></div><?php
							}
						}
						echo $this->controller->render;
					}
				} else {
				?>
					<div id="page-content">

						<ul class="breadcrumb breadcrumb-top">
							<li>Index</li>
						</ul>
					<?php
					Notification::error('Fichier controller de la page : <strong> '.$page.'</strong> non disponible...', 'Fichier');
					?></div><?php
				}
			} else if (isset($_REQUEST['widgets']) and $_REQUEST['widgets'] == true) {
				$scan = Common::ScanDirectory(MANAGEMENTS.'widgets');
				if (in_array($page, $scan)) {
					include MANAGEMENTS.'widgets'.DS.$page.DS.'controller.php';
					$this->controller = new $this->controller();
					if ($this->controller->active === true) {
						if (method_exists($this->controller, $this->view)) {
							unset($this->links[0], $this->links[1]);
							call_user_func_array(array($this->controller,$this->view),$this->links);
						} else {
							?>
							<div id="page-content">

								<ul class="breadcrumb breadcrumb-top">
									<li>Index</li>
								</ul>
							<?php
							Notification::error('La sous-page demander <strong>'.$this->view.'</strong> n\'est pas disponible dans la page : <strong>'.$page.'</strong>', 'Fichier');
							?></div><?php
						}
					}
					echo $this->controller->render;
				} else {
					?>
					<div id="page-content">

						<ul class="breadcrumb breadcrumb-top">
							<li>Index</li>
						</ul>
					<?php
					Notification::error('Fichier controller de la page : <strong> '.$page.'</strong> non disponible...', 'Fichier');
					?></div><?php
				}
			} else if (isset($_REQUEST['parameter']) and $_REQUEST['parameter'] == true) {
				$scan = Common::ScanDirectory(MANAGEMENTS.'parameter');
				if (in_array($page, $scan)) {
					if (Secures::getAccessPageAdmin($page) === false) {
						?>
						<div id="page-content">

							<ul class="breadcrumb breadcrumb-top">
								<li>Index</li>
							</ul>
						<?php
						Notification::error(NO_ACCESS_GROUP_PAGE, 'Page');
						?></div><?php
						$page = defined(strtoupper($page)) ? constant(strtoupper($page)) : $page;
						$Interaction = New Interaction;
						$Interaction->user($_SESSION['USER']['HASH_KEY']);
						$Interaction->type('error');
						$Interaction->title('Accès non autorisé');
						$Interaction->text('Accès non autorisé de '.Users::hashkeyToUsernameAvatar($_SESSION['USER']['HASH_KEY']).' à la page '.$page.' : paramètre');
						$Interaction->insert();
					} else {
						include MANAGEMENTS.'parameter'.DS.$page.DS.'controller.php';
						$this->controller = new $this->controller();
						if ($this->controller->active === true) {
							if (method_exists($this->controller, $this->view)) {
								unset($this->links[0], $this->links[1]);
								call_user_func_array(array($this->controller,$this->view),$this->links);
							} else {
								?>
								<div id="page-content">

									<ul class="breadcrumb breadcrumb-top">
										<li>Index</li>
									</ul>
								<?php
								Notification::error('La sous-page demander <strong>'.$this->view.'</strong> n\'est pas disponible dans la page : <strong>'.$page.'</strong>', 'Fichier');
								?>
								</div>
								<?php
							}
						}
						echo $this->controller->render;
					}
				} else {
					Notification::error('Fichier controller de la page : <strong> '.$page.'</strong> non disponible...', 'Fichier');
				}
			} else if (isset($_REQUEST['gaming']) and $_REQUEST['gaming'] == true) {
				$scan = Common::ScanDirectory(MANAGEMENTS.'gaming');
				if (in_array($page, $scan)) {
					if (Secures::getAccessPageAdmin($page) === false) {
						Notification::error(NO_ACCESS_GROUP_PAGE, 'Page');
						$page = defined(strtoupper($page)) ? constant(strtoupper($page)) : $page;
						$Interaction = New Interaction;
						$Interaction->user($_SESSION['USER']['HASH_KEY']);
						$Interaction->type('error');
						$Interaction->title('Accès non autorisé');
						$Interaction->text('Accès non autorisé de '.Users::hashkeyToUsernameAvatar($_SESSION['USER']['HASH_KEY']).' à la page '.$page.' : paramètre');
						$Interaction->insert();
					} else {
						include MANAGEMENTS.'gaming'.DS.$page.DS.'controller.php';
						$this->controller = new $this->controller();
						if ($this->controller->active === true) {
							if (method_exists($this->controller, $this->view)) {
								unset($this->links[0], $this->links[1]);
								call_user_func_array(array($this->controller,$this->view),$this->links);
							} else {
								Notification::error('La sous-page demander <strong>'.$this->view.'</strong> n\'est pas disponible dans la page : <strong>'.$page.'</strong>', 'Fichier');
							}
						}
						echo $this->controller->render;
					}
				} else {
					Notification::error('Fichier controller de la page : <strong> '.$page.'</strong> non disponible...', 'Fichier');
				}
			} else {
				include MANAGEMENTS.'intern'.DS.'dashboard.php';
				$render = ob_get_contents();
			}
		}

		$render = ob_get_contents();

		if (ob_get_length() != 0) {
			ob_end_clean();
		}

		return $render;
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
					sleep(2);
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
			$return['/'.$v.'?management&page=true'] = defined(strtoupper($v)) ? constant(strtoupper($v)) : $v;
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
			$return['/'.$v.'?management&widgets=true'] = defined(strtoupper($v)) ? constant(strtoupper($v)) : $v;
		}
		return $return;
	}
	#########################################
	# Menu gaming
	#########################################
	private function menuGaming ()
	{
		$gaming  = self::getGaming ();
		$return   = array();

		foreach ($gaming as $k => $v) {
			$return['/'.$v.'?management&gaming=true'] = defined(strtoupper($v)) ? constant(strtoupper($v)) : $v;
		}
		return $return;
	}
	#########################################
	# Menu parameter
	#########################################
	private function menuParameter ()
	{
		$parameter  = self::getParameter ();
		$return   = array();

		foreach ($parameter as $k => $v) {
			$return['/'.$v.'?management&parameter=true'] = defined(strtoupper($v)) ? constant(strtoupper($v)) : $v;
		}
		return $return;
	}
	#########################################
	# Scan le dossier des pages
	#########################################
	private function getPages ()
	{
		$scan = Common::ScanDirectory(MANAGEMENTS.'pages', true);
		return $scan;
	}
	#########################################
	# Scan le dossier des widgets
	#########################################
	private function getWidgets ()
	{
		$scan = Common::ScanDirectory(MANAGEMENTS.'widgets', true);
		return $scan;
	}
	#########################################
	# Scan le dossier gaming
	#########################################
	private function getGaming ()
	{
		$scan = Common::ScanDirectory(MANAGEMENTS.'gaming', true);
		return $scan;
	}
	#########################################
	# Scan le dossier parameter
	#########################################
	private function getParameter ()
	{
		$scan = Common::ScanDirectory(MANAGEMENTS.'parameter', true);
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