
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

class Managements extends Pages
{
	var $models = array('ModelsManagements');

	public function index ()
	{
		$d = array();

		if (isset($_SESSION['USER']['HASH_KEY']) && strlen ($_SESSION['USER']['HASH_KEY']) == 32) {
			$d['user']    = current (Users::getInfosUser ($_SESSION['USER']['HASH_KEY']));
			$d['members'] = $this->ModelsManagements->getAllUsers ();
			$d['config']  = $this->ModelsManagements->getConfig ();
			$d['update']  = $this->ModelsManagements->getMaintenance ();
			$d['pages']   = $this->ModelsManagements->getPages ();
		}

		$this->set($d);
		$this->render('index');
	}

	public function pages ($dir, $page)
	{
		if (Secures::getAccessPageGroups()) {
			$models = $dir.$page;
			$page = 'pages/'.$dir.'/'.$page;
			$set = $this->ModelsManagements->$models ();
			$this->set($set);
			$this->render($page);		
		}
	}

	public function detail ($hash_key)
	{
		if (isset($_SESSION['USER']['HASH_KEY']) && strlen($_SESSION['USER']['HASH_KEY']) == 32) {
			if (isset($hash_key) && strlen($hash_key) == 32) {
				$data['user']   = $this->ModelsManagements->getUsers ($hash_key);
				$data['profil'] = $this->ModelsManagements->getUsersProfils ($hash_key);
				$data['social'] = $this->ModelsManagements->getUsersSocial ($hash_key);
				$this->set($data);
				$this->render('detail');
			}
		}
	}

	function registerGeneral ()
	{
		if (isset($_SESSION['USER']['HASH_KEY']) && strlen ($_SESSION['USER']['HASH_KEY']) == 32) {
			$return = $this->ModelsManagements->sendRG ($_POST);
			$this->error(get_class($this), $return['text'], $return['type']);
			$this->redirect('Managements', 2);
		}
	}

	public function registerMtn ()
	{
		if (isset($_SESSION['USER']['HASH_KEY']) && strlen ($_SESSION['USER']['HASH_KEY']) == 32) {
			$return = $this->ModelsManagements->sendRGMtn ($_POST);
			$this->error(get_class($this), $return['text'], $return['type']);
			$this->redirect('Managements', 2);
		}
	}

	public function logout ()
	{
		$return = $this->ModelsManagements->sendLogout();
		$return['msg']  = 'Votre session management se termine.';
		$return['type'] = 'success';
		$this->error('Logout', $return['msg'], $return['type']);
		$this->redirect('user', 3);
	}

	public function sendPrivate ($id = null)
	{
		if ($id !== null && is_numeric($id)) {
			$_POST['id'] = (int) $id;
			$return = $this->ModelsManagements->sendPrivate ($_POST);
			$this->error(get_class($this), $return['text'], $return['type']);
		} else {
			$this->error(get_class($this), 'No id valid', 'error');
		}
		$this->redirect('managements', 2);
	}

	public function sendMainGroup ()
	{
		$return = $this->ModelsManagements->sendMainGroup ($_POST['main']);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('managements', 2);
	}

	public function sendSecondGroup ()
	{
		$return = $this->ModelsManagements->sendSecondGroup ($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('managements', 2);
	}

	public function sendSocial ()
	{
		$return = $this->ModelsManagements->sendSocial ($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('managements', 2);
	}

	public function sendInfoPublic ()
	{
		$return = $this->ModelsManagements->sendInfoPublic ($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('managements', 2);
	}

}