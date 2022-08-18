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

class AdminPages
{
	var $active;
	var $vars  = array();
	var $admin = false;

	public $render = null;

	function __construct()
	{
		self::loadLang();

		if ($this->active === false) {
			self::pageOff();
			Notification::error('Page fermer manuellement, via le fichier : controller.');
		} else if ($this->admin === true) {
			if (Users::isSuperAdmin() === false) {
				self::superAdmin();
			}	
		}

		if (isset($this->models)){
			foreach($this->models as $v){
				$this->loadModel($v);
			}
		}
	}
	#########################################
	# Page désactiver manuellement
	#########################################
	private function pageOff ()
	{
		ob_start();
		
		Notification::warning('La page demander n\'est pas accesible', 'Page');

		$this->render = ob_get_contents();

		if (ob_get_length() != 0) {
			ob_end_clean();
		}
		return;
	}
	#########################################
	# Page uniquement au admin supreme (grp 1)
	#########################################
	private function superAdmin ()
	{
		ob_start();
		?>
		<div id="page-content">

			<div class="content-header">
			<?php
				Notification::error('La page demander n\'est accesible qu\'aux administrateur de niveau 1', 'Page');
				$this->render = ob_get_contents();

			if (ob_get_length() != 0) {
				ob_end_clean();
			}
			?>
			</div>
		</div>
		<?php	
		return;
	}
	#########################################
	# Enregsitre les variables dans vars
	#########################################
	function set ($d) {
		$this->vars = array_merge($this->vars,$d);
	}
	#########################################
	# Rendu de la page demander
	#########################################
	public function render ($filename, $menu = array())
	{
		extract($this->vars);
		ob_start();

		if ($this->admin === true) {
			if (Users::isSuperAdmin() === false) {
				self::superAdmin();
				return;
			}
		}

		if (isset($_REQUEST['pages'])) {
			$filename = MANAGEMENTS.'pages'.DS.strtolower(get_class($this)).DS.$filename.'.php';
		} else if (isset($_REQUEST['widgets'])) {
			$filename = MANAGEMENTS.'widgets'.DS.strtolower(get_class($this)).DS.$filename.'.php';
		} else if (isset($_REQUEST['parameter'])) {
			$filename = MANAGEMENTS.'parameter'.DS.strtolower(get_class($this)).DS.$filename.'.php';
		} else if (isset($_REQUEST['gaming'])) {
			$filename = MANAGEMENTS.'gaming'.DS.strtolower(get_class($this)).DS.$filename.'.php';
		} else if (isset($_REQUEST['templates'])) {
			$filename = MANAGEMENTS.'templates'.DS.strtolower(get_class($this)).DS.$filename.'.php';
		} else if (isset($_REQUEST['users'])) {
			$filename = MANAGEMENTS.'users'.DS.strtolower(get_class($this)).DS.$filename.'.php';
		}

		?>
			<?php
			if (!empty($menu)):
				$title = defined(strtoupper(get_class($this))) ? constant(strtoupper(get_class($this))) : get_class($this);
			?>
			<div class="card mt-3">
				<div class="card-header">
					<h3 style="padding: 0;margin: 0;" class="card-title">Menu Principal : <?=$title;?></h3>
			  	</div>
			  	<div class="card-body">
					<?php
					foreach ($menu as $k => $v) {
						foreach ($v as $key => $value) {
							if (empty($value['color'])) {
								$value['color'] = '';
							}
						?>
					<a class="btn btn-app <?=$value['color']?>" href="<?=$value['href']?>">
						<i class="<?=$value['icon']?>"></i>
							<?=$key?>
					</a>
						<?php
						}  		
					}
					?>
				</div>
			</div>
			<?php
			endif;		
		if (is_file($filename)) {
			require $filename;
		} else {
			Notification::error('Fichier : <strong>'.$filename.' </strong>non disponible...', 'Fichier');
		}

		$this->render = ob_get_contents();
		?>
		</div>
		<?php
		if (ob_get_length() != 0) {
			ob_end_clean();
		}
	}
	#########################################
	# récupère le models (BDD)
	#########################################
	private function loadModel ($name)
	{
		if (isset($_REQUEST['pages'])) {
			$dir = self::getDir('pages');
		} else if (isset($_REQUEST['widgets'])) {
			$dir = self::getDir('widgets');
		} else if (isset($_REQUEST['gaming'])) {
			$dir = self::getDir('gaming');
		} else if (isset($_REQUEST['templates'])) {
			$dir = self::getDir('templates');
		} else if (isset($_REQUEST['parameter'])) {
			$dir = self::getDir('parameter');
		} else if (isset($_REQUEST['users'])) {
			$dir = self::getDir('users');
		}

		if (is_file($dir)) {
			require_once $dir;
			$this->$name = new $name();
		} else {
			Notification::error('Fichier models manquant', 'Models');
		}
	}

	private function getDir ($data = null)
	{
		return MANAGEMENTS.$data.DS.strtolower(get_class($this)).DS.'models.php';
	}
	#########################################
	# récupère le fichier lang
	#########################################
	private function loadLang ()
	{
		if (isset($_REQUEST['pages'])) {
			$dir = MANAGEMENTS.'pages'.DS.strtolower(get_class($this)).DS.'lang'.DS.'lang.'.CMS_WEBSITE_LANG.'.php';
		} else if (isset($_REQUEST['widgets'])) {
			$dir = MANAGEMENTS.'widgets'.DS.strtolower(get_class($this)).DS.'lang'.DS.'lang.'.CMS_WEBSITE_LANG.'.php';
		} else if (isset($_REQUEST['gaming'])) {
			$dir = MANAGEMENTS.'gaming'.DS.strtolower(get_class($this)).DS.'lang'.DS.'lang.'.CMS_WEBSITE_LANG.'.php';
		} else if (isset($_REQUEST['templates'])) {
			$dir = MANAGEMENTS.'templates'.DS.strtolower(get_class($this)).DS.'lang'.DS.'lang.'.CMS_WEBSITE_LANG.'.php';
		} else if (isset($_REQUEST['parameter'])) {
			$dir = MANAGEMENTS.'parameter'.DS.strtolower(get_class($this)).DS.'lang'.DS.'lang.'.CMS_WEBSITE_LANG.'.php';
		} else if (isset($_REQUEST['users'])) {
			$dir = MANAGEMENTS.'users'.DS.strtolower(get_class($this)).DS.'lang'.DS.'lang.'.CMS_WEBSITE_LANG.'.php';
		}

		if (is_file($dir)) {
			require_once $dir;
		}
	}
	#########################################
	# Retourne erreur ou le texte defini
	#########################################
	function error ($title, $msg, $type)
	{
		ob_start();
		?>
		<div id="page-content">
			<ul class="breadcrumb breadcrumb-top">
				<li>Index</li>
			</ul>
			<?php
			Notification::$type($msg, $title);
			$this->render = ob_get_contents();
			?>
		</div>
		<?php
		ob_end_clean();
	}
	#########################################
	# Retourne le debug
	#########################################
	function debug($d) {
		ob_start();
		debug($d);
		$this->render = ob_get_contents();
		ob_end_clean();
	}
	#########################################
	# Redirection
	#########################################
	function redirect ($url = null, $time = null)
	{
		if ($url === true) {
			$url = $_SERVER['HTTP_REFERER'];
			//header("refresh:$time;url='$url'");
			header("Refresh:$time");
		}

		$scriptName = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

		$fullUrl = ($_SERVER['HTTP_HOST'].$scriptName);

		if (!strpos($_SERVER['HTTP_HOST'], $scriptName)) {
			$fullUrl = $_SERVER['HTTP_HOST'].$scriptName.$url;
		}

		if (!strpos($fullUrl, 'http://')) {
			if ($_SERVER['SERVER_PORT'] == 80) {
				$url = 'http://'.$fullUrl;
			} else if ($_SERVER['SERVER_PORT'] == 443) {
				$url = 'https://'.$fullUrl;
			} else {
				$url = 'http://'.$fullUrl;
			}
		}
		header("refresh:$time;url='$url'");
	}
}