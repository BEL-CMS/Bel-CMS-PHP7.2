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

class Calendar extends AdminPages
{
	var $active = true;
	var $models = array('ModelsCalendar');

	public function index ()
	{
		$menu[] = array('Accueil'      => array('href'=>'/calendar?management&pages','icon'=>'fa fa-home'));
		$menu[] = array('Ajouter'      => array('href'=>'/calendar/add?management&pages','icon'=>'fa fa-plus'));
		$menu[] = array('Catégories'   => array('href'=>'/calendar/addcat?management&pages','icon'=>'fa fa-cogs'));
		$menu[] = array('Configuration'=> array('href'=>'/calendar/parameter?management&pages','icon'=>'fa fa-cubes'));
		$this->render('index', $menu);
	}

	public function add ()
	{
		$menu[] = array('Accueil'      => array('href'=>'/calendar?management&pages','icon'=>'fa fa-home'));
		$menu[] = array('Catégories'   => array('href'=>'/calendar/cat?management&pages','icon'=>'fa fa-cogs'));
		$menu[] = array('Configuration'=> array('href'=>'/calendar/parameter?management&pages','icon'=>'fa fa-cubes'));
		$this->render('add', $menu);
	}

	public function sendadd ()
	{
		$return = $this->ModelsCalendar->sendadd ($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/calendar?management&pages', 2);
	}

	public function addcat ()
	{
		$this->render('cat');
	}

	public function sendnewcat()
	{
		$return = $this->ModelsCalendar->sendnewcat ($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('/calendar?management&pages', 2);
	}

	public function getEvents ()
	{
		$return = $this->ModelsCalendar->getEvents();
		echo json_encode($return);
	}
}