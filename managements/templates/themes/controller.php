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

class Themes extends AdminPages
{
	var $admin     = true; // Admin suprême uniquement (Groupe 1);
	var $active    = true;
	var $models    = array('ModelsThemes');

	public function index ()
	{
		$menu[] = array('Accueil'=> array('href'=>'/themes?management&templates','icon'=>'fa fa-home'));
		$menu[] = array('Dimension'=> array('href'=>'/themes/dim?management&templates','icon'=>'fa fa-solid fa-arrows-left-right-to-line'));

		$actual = $this->ModelsThemes->getTplActive();
		$actual = $actual->value;

		$screen = $this->ModelsThemes->getTplImg();

		$return = array();

		$data = $this->ModelsThemes->getTpl();
		foreach ($data as $k => $n) {
			$return[$n] = array();
		}
		foreach ($return as $name => $value):

			$return[$name]['name'] = $name;

			if (array_key_exists($name, $screen)):
				$return[$name]['screen'] = $screen[$name];
			endif;

			if (strtolower($name) == strtolower($actual)):
				$return[$name]['active'] = true;
			else:
				$return[$name]['active'] = 0;
			endif;

			$d = $this->ModelsThemes->getInfos($name);
			$return[$name]['creator']     = $d['creator'];
			$return[$name]['description'] = $d['description'];
			$return[$name]['version']     = $d['version'];
			$return[$name]['date']        = $d['date'];

		endforeach;

		$data['themes'] = $return;

		$this->set($data);
		$this->render('index', $menu);
	}

	public function send ($data)
	{
		$return = $this->ModelsThemes->sendTpl($data);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('themes?management&templates', 2);
	}

	public function dim ()
	{
		foreach ($this->ModelsThemes->searchPages() as $key => $value) {
			$p[] = trim($value);
		}
		$data['pages']  = $p;
		$scan           = Common::ScanDirectory('pages', true);
		foreach ($scan as $key => $value) {
			$d[] = trim($value);
		}
		$data['scan']   = $d;
		$this->set($data);
		$this->render('dim');
	}

	public function sendpages ()
	{
		$return = $this->ModelsThemes->sendPages($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('themes?management&templates', 2);	
	}
}