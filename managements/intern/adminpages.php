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
		        <ul class="nav-horizontal text-center">
		        	<?php
		Notification::error('La page demander n\'est accesible qu\'aux administrateur suprême', 'Page');

		$this->render = ob_get_contents();

		if (ob_get_length() != 0) {
			ob_end_clean();
		}
		?>
		        </ul>
		    </div>
		    <ul class="breadcrumb breadcrumb-top">
		        <li>Index</li>
		    </ul>
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

		if (isset($_REQUEST['page']) and $_REQUEST['page'] == true) {
			$filename = MANAGEMENTS.'pages'.DS.strtolower(get_class($this)).DS.$filename.'.php';
		} else if (isset($_REQUEST['widgets']) && $_REQUEST['widgets'] == true) {
			$filename = MANAGEMENTS.'widgets'.DS.strtolower(get_class($this)).DS.$filename.'.php';
		} else if (isset($_REQUEST['parameter']) && $_REQUEST['parameter'] == true) {
			$filename = MANAGEMENTS.'parameter'.DS.strtolower(get_class($this)).DS.$filename.'.php';
		} else if (isset($_REQUEST['gaming']) && $_REQUEST['gaming'] == true) {
			$filename = MANAGEMENTS.'gaming'.DS.strtolower(get_class($this)).DS.$filename.'.php';
		}

		?>
		<div id="page-content">
		    <div class="content-header">
		        <ul class="nav-horizontal text-center">
		        	<?php
		        	foreach ($menu as $k => $v) {
		        		foreach ($v as $key => $value) {
		        		?>
			            <li class="active">
			                <a href="<?=$value['href']?>"><i class="<?=$value['icon']?>"></i> <?=$key?></a>
			            </li>
			            <?php
		        		}  		
		        	}
		        	?>
		        </ul>
		    </div>
		    <ul class="breadcrumb breadcrumb-top">
		        <li>Index</li>
		    </ul>
		<?php		
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
		if (isset($_REQUEST['page']) and $_REQUEST['page'] == true) {
			$dir = MANAGEMENTS.'pages'.DS.strtolower(get_class($this)).DS.'models.php';
		} else if (isset($_REQUEST['widgets']) && $_REQUEST['widgets'] == true) {
			$dir = MANAGEMENTS.'widgets'.DS.strtolower(get_class($this)).DS.'models.php';
		} else if (isset($_REQUEST['gaming']) && $_REQUEST['gaming'] == true) {
			$dir = MANAGEMENTS.'gaming'.DS.strtolower(get_class($this)).DS.'models.php';
		} else if ($_REQUEST['parameter'] == true) {
			$dir = MANAGEMENTS.'parameter'.DS.strtolower(get_class($this)).DS.'models.php';
		}

		if (is_file($dir)) {
			require_once $dir;
			$this->$name = new $name();
		} else {
			Notification::error('Fichier models manquant', 'Models');
		}
	}
	#########################################
	# récupère le fichier lang
	#########################################
	private function loadLang ()
	{
		if (isset($_REQUEST['page']) and $_REQUEST['page'] == true) {
			$dir = MANAGEMENTS.'pages'.DS.strtolower(get_class($this)).DS.'lang'.DS.'lang.'.CMS_WEBSITE_LANG.'.php';
		} else if (isset($_REQUEST['widgets']) && $_REQUEST['widgets'] == true) {
			$dir = MANAGEMENTS.'widgets'.DS.strtolower(get_class($this)).DS.'lang'.DS.'lang.'.CMS_WEBSITE_LANG.'.php';
		} else if (isset($_REQUEST['gaming']) && $_REQUEST['gaming'] == true) {
			$dir = MANAGEMENTS.'gaming'.DS.strtolower(get_class($this)).DS.'lang'.DS.'lang.'.CMS_WEBSITE_LANG.'.php';
		} else if ($_REQUEST['parameter'] == true) {
			$dir = MANAGEMENTS.'parameter'.DS.strtolower(get_class($this)).DS.'lang'.DS.'lang.'.CMS_WEBSITE_LANG.'.php';
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