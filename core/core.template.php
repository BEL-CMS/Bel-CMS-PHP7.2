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

final class Template  extends Dispatcher
{
	var $dirTpl = null;
	public $render;

	private static $authorizedVar = array (
		'css',
		'js',
		'keywords',
		'description',
		'title',
		'breadcrumb',
		'base'
	);

	function __construct ()
	{
		parent::__construct();

		$this->title           = CMS_WEBSITE_NAME;
		$this->keywords        = CMS_WEBSITE_KEYWORDS;
		$this->description     = CMS_WEBSITE_DESCRIPTION;
		$this->css             = self::CascadingStyleSheets ();
		$this->js              = self::JavaScript ();
		$this->breadcrumb      = self::BreadCrumb ();
		$this->base            = GetHost::getBaseUrl ();

		if (defined('CMS_TPL_WEBSITE') && !empty(constant('CMS_TPL_WEBSITE')) ) {
			$this->dirTpl = DIR_TPL.CMS_TPL_WEBSITE;
		} else {
			$this->dirTpl = DIR_TPL_DEFAULT;
		}

		self::assembly ();
	}

	private function assembly ()
	{
		ob_start();

		$head          = self::headBuffer ();
		$header        = self::headerBuffer ();
		$body          = self::bodyBuffer ();
		$footer        = self::footerBuffer ();

		echo $head.$header.$body.$footer;

		$this->render = ob_get_contents();

		if (ob_get_length() != 0) {
			ob_end_clean();
		}	
	}
	#########################################
	# Récupère le heade défaut ou du template
	#########################################
	private function headBuffer ()
	{
		ob_start();
		if (is_file($this->dirTpl.'head.tpl')) {
			require $this->dirTpl.'head.tpl';
			$head = ob_get_contents();
			foreach (self::$authorizedVar as $var) {
				$head = str_replace('{'.trim($var).'}', $this->$var, $head);
			}
		} else {
			Notification::error('Unknow File head.tpl', 'Error');
			$head = ob_get_contents ();
		}
		
		if (ob_get_length () != 0) {
			ob_end_clean ();
		}
		return $head;	
	}
	#########################################
	# Récupère le header défaut ou du template
	#########################################
	private function headerBuffer ()
	{
		ob_start();
		$widgetsTop = self::widgetsTopBuffer ();
		if (is_file($this->dirTpl.'header.tpl')) {
			require $this->dirTpl.'header.tpl';
			$header = ob_get_contents ();
			foreach (self::$authorizedVar as $var) {
				$header = str_replace('{'.trim($var).'}', $this->$var, $header);
			}
		} else {
			Notification::error('Unknow File header.tpl', 'Error');
			$header = ob_get_contents ();
		}
		
		if (ob_get_length () != 0) {
			ob_end_clean ();
		}
		return $header;	
	}
	#########################################
	# Récupère le body défaut ou du template
	#########################################
	private function bodyBuffer ()
	{
		ob_start();

		$widgetsLeft  = self::widgetsLeftBuffer ();
		$widgetsRight = self::widgetsRightBuffer ();

		if (is_file($this->dirTpl.'body.tpl')) {
			$assemblyPage = new AssemblyPages ();
			$assemblyPage->getRender ();
			$page = $assemblyPage->render;
			require $this->dirTpl.'body.tpl';
			$body = ob_get_contents ();
		} else {
			Notification::error('Unknow File body.tpl', 'Error');
			$body = ob_get_contents ();
		}
		
		if (ob_get_length () != 0) {
			ob_end_clean ();
		}
		return $body;	
	}
	#########################################
	# Récupère le footer défaut ou du template
	#########################################
	private function footerBuffer ()
	{
		ob_start();
		$loadingPage = round((explode(' ', microtime())[0] + explode(' ', microtime())[1]) - $GLOBALS['TIME_START'], 3);
		$widgetsBottom = self::widgetsBottomBuffer ();
		if (is_file($this->dirTpl.'footer.tpl')) {
			require $this->dirTpl.'footer.tpl';
			$footer = ob_get_contents ();
			foreach (self::$authorizedVar as $var) {
				$footer = str_replace ('{'.trim($var).'}', $this->$var, $footer);
			}
		} else {
			Notification::error('Unknow File footer.tpl', 'Error');
			$footer = ob_get_contents ();
		}
		
		if (ob_get_length () != 0) {
			ob_end_clean ();
		}
		return $footer;
	}
	#########################################
	# Récupère le widgets haut 
	#########################################
	private function widgetsTopBuffer ()
	{
		$widgetsTop = null;
		ob_start();
		if (is_file($this->dirTpl.'widgets.top.tpl')) {
			require $this->dirTpl.'widgets.top.tpl';
			$widgets = null;
			$widgetsTop = ob_get_contents ();
		}
		if (ob_get_length () != 0) {
			ob_end_clean ();
		}
		return $widgetsTop;
	}
	#########################################
	# Récupère le widgets bas
	#########################################
	private function widgetsBottomBuffer ()
	{
		$widgetsBottom = null;
		ob_start();
		if (is_file($this->dirTpl.'widgets.bottom.tpl')) {
			require $this->dirTpl.'widgets.bottom.tpl';
			$widgets = null;
			$widgetsBottom = ob_get_contents ();
		}
		if (ob_get_length () != 0) {
			ob_end_clean ();
		}
		return $widgetsBottom;
	}
	#########################################
	# Récupère le widgets droite 
	#########################################
	private function widgetsLeftBuffer ()
	{
		$widgetsLeft = null;
		ob_start();
		if (is_file($this->dirTpl.'widgets.left.tpl')) {
			require $this->dirTpl.'widgets.left.tpl';
			$widgets = null;
			$widgetsLeft = ob_get_contents ();
		}
		if (ob_get_length () != 0) {
			ob_end_clean ();
		}
		return $widgetsLeft;
	}
	#########################################
	# Récupère le widgets gauche 
	#########################################
	private function widgetsRightBuffer ()
	{
		$widgetsRight = null;
		ob_start();
		if (is_file($this->dirTpl.'widgets.right.tpl')) {
			require $this->dirTpl.'widgets.right.tpl';
			$widgets = null;
			$widgetsRight = ob_get_contents ();
		}
		if (ob_get_length () != 0) {
			ob_end_clean ();
		}
		return $widgetsRight;
	}
	#########################################
	# Gestions des styles (css)
	#########################################
	public function cascadingStyleSheets ()
	{
		$files          = array();
		$return         = '';
		/* GLOBAL STYLE */
		$files[] = 'assets/styles/belcms.global.css';
		// NOTIFICATION */
		$files[] = 'assets/styles/belcms.notification.css';
		/* BOOTSTRAP 4.1.3 */
		$files[] = 'assets/plugins/bootstrap-4.1.3/css/bootstrap.min.css';
		/* FONTAWASOME 5.4.2 ALL */
		$files[] = 'assets/plugins/fontawesome-5.4.2/css/all.min.css';

		if (is_file(ROOT.'pages'.DS.$this->controller.DS.'css'.DS.'styles.css')) {
			$files[] = 'pages'.DS.$this->controller.DS.'css'.DS.'styles.css';
		}

		foreach ($files as $v) {
			$return .= '	<link href="'.$v.'" rel="stylesheet" type="text/css" media="all">'.PHP_EOL;
		}

		return trim($return);

	}
	#########################################
	# Gestions des scripts (js)
	#########################################
	public function javaScript ()
	{
		$files          = array();
		$return         = '';

		$files[] = 'assets/plugins/jquery-3.3.1/jquery-3.3.1.min.js';
		$files[] = 'assets/plugins/belcms.core.js';
		/* BOOTSTRAP 4.1.3 */
		$files[] = 'assets/plugins/bootstrap-4.1.3/js/popper.min.js';
		$files[] = 'assets/plugins/bootstrap-4.1.3/js/bootstrap.min.js';

		if (is_file(ROOT.'pages'.DS.$this->controller.DS.'js'.DS.'javascripts.js')) {
			$files[] = 'pages'.DS.$this->controller.DS.'js'.DS.'javascripts.js';
		}

		foreach ($files as $v) {
			$return .= '	<script type="text/javascript" src="'.$v.'"></script>'.PHP_EOL;
		}
		return trim($return);
	}
	#########################################
	# Breadcrumb
	#########################################
	public function breadCrumb ()
	{
		$return  = '<nav aria-label="breadcrumb"><ol class="breadcrumb">';
		$return .= '<li class="breadcrumb-item"><a href="Home">'.constant('HOME').'</a></li>';

		if ($this->controller != 'blog') {
			$return .= '<li class="breadcrumb-item"><a href="'.$this->controller.'">'.Common::translate($this->controller).'</a></li>';
			if ($this->view != 'index') {
				$return .= '<li class="breadcrumb-item"><a href="'.ucfirst($this->controller).'/'.$this->view.'">'.Common::translate($this->view).'</a></li>';
				if (!empty($this->links[2])) {

					$return .= '<li class="breadcrumb-item active"><a href="'.ucfirst($this->controller).'/'.$this->view.'/'.$this->links[2].'">'.$this->links[2].'</a></li>';
				}
			}
		}
		$return .= '</ol></nav>';
		return $return;
	}
}