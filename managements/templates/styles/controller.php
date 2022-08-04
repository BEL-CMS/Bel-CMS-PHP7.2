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

class Styles extends AdminPages
{
	#########################################
	# Variables
	#########################################
	var $admin  = true; // Admin suprême uniquement (Groupe 1);
	var $active = true; // activation manuel;
	var $models = array('ModelsStyles');
	#########################################
	# Premiere page avec le rendu de la page index.php
	#########################################
	public function index ()
	{
		$this->render('index');
	}
	#########################################
	# Recupere le styles.css de la page
	#########################################
	public function edit ($page)
	{
		$return['data'] = $this->ModelsStyles->getStylesCss ($page);
		$return['page'] = $page;
		$this->set($return);
		$this->render ('edit');
	}
	#########################################
	# Sauvegarde du fichier styles.css de la page
	#########################################
	public function send ()
	{
		$return = $this->ModelsStyles->sendEditCss ($_POST['content'], $_POST['page']);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('styles?management&templates', 2);
	}
	#########################################
	# Recupere le styles.css du widget
	#########################################
	public function editWidgets ($widget)
	{
		$return['data']   = $this->ModelsStyles->getStylesCssWidgets ($widget);
		$return['widget'] = $widget;
		$this->set($return);
		$this->render ('editwidget');
	}
	#########################################
	# Sauvegarde du fichier styles.css du widget
	#########################################
	public function sendWidget ()
	{
		$return = $this->ModelsStyles->sendEditCssWidget ($_POST['content'], $_POST['widget']);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('styles?management&templates', 2);
	}
}