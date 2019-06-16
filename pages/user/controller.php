<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.3.0
 * @link http://www.bel-cms.be
 * @link http://www.stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2016 Bel-CMS
 * @author Stive - mail@stive.eu
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class User extends Pages
{
	var $models = array('ModelsUser');
	private $_error = false;

	public function index ()
	{
		if (Users::isLogged() === true) {
			$d = array();
			$d['user'] = $this->ModelsUser->getDataUser($_SESSION['USER']['HASH_KEY']);
			$this->set($d);
			$this->render('index');
		} else {
			$this->redirect('User/login&echo', 3);
			Notification::warning(LOGIN_REQUIRE);
		}
	}
	public function profil ()
	{
		$d = array();
		$d['user'] = $this->ModelsUser->getDataUser($_SESSION['USER']['HASH_KEY']);
		$this->set($d);
		$this->render('index');
	}
	public function login ()
	{
		if (Users::isLogged() === false) {
			$this->render('login');
		} else {
			$d = array();
			$d['user'] = $this->ModelsUser->getDataUser($_SESSION['USER']['HASH_KEY']);
			$this->set($d);
			$this->render('index');
		}
	}
	public function register ()
	{
			if (Users::isLogged() === false) {
				$_SESSION['TMP_QUERY_REGISTER'] = array();
				$_SESSION['TMP_QUERY_REGISTER']['number_1'] = rand(1, 9);
				$_SESSION['TMP_QUERY_REGISTER']['number_2'] = rand(1, 9);
				$_SESSION['TMP_QUERY_REGISTER']['overall']  = $_SESSION['TMP_QUERY_REGISTER']['number_1'] + $_SESSION['TMP_QUERY_REGISTER']['number_2'];
				$_SESSION['TMP_QUERY_REGISTER'] = Common::arrayChangeCaseUpper($_SESSION['TMP_QUERY_REGISTER']);
				$this->data = (bool) true;
				$this->render('register');
			} else {
				$this->redirect('user', 0);
			}
	}
	public function logout ()
	{
			$return = Users::logout();
			$this->error('Logout', $return['msg'], $return['type']);
			$this->redirect('user', 3);
	}
	public function lostpassword ()
	{
			if (Users::isLogged() === false) {
				$this->data = (bool) true;
				$this->render('lostpassword');
			}
	}
	private function sendLostPassword ()
	{
			unset($this->data['send']);
			$return = $this->ModelsUser->checkToken($this->data);
			if (!isset($return['pass'])) {
				$this->error('Password', $return['msg'], $return['type']);
				$this->redirect('User/LostPassword', 3);
			} else {
				$this->error('Password', $return['msg'], $return['type']);
			}
	}

	public function sendRegister ()
	{
		if (empty($this->data)) {
			Notification::alert('Pas de données');
			$this->redirect('user&echo', 2);
		} else if (
			empty($this->data['email']) or 
			empty($this->data['username']) or 
			empty($this->data['password']) or 
			empty($this->data['passwordrepeat']) or 
			empty($this->data['query_register'])
		) {
			Notification::alert('Un des champs obligatoire n\'est pas rempli');
			$this->redirect('User/register&echo', 3);
		} else {
			$return = $this->ModelsUser->sendRegistration($this->data);
			
			if ($return['type'] == 'error') {
				Notification::error($return['msg']);
				$this->redirect('User/register&echo', 3);
			} else if ($return['type'] == 'warning') {
				$this->redirect('User/register&echo', 3);
				Notification::warning($return['msg']);
			} else if ($return['type'] == 'success') {
				$this->redirect('User/Profil', 3);
				Notification::success($return['msg']);
			} else {
				$this->redirect('User/register&echo', 3);
				Notification::warning('Erreur inconnu');
			}
		}
	}
	public function sendLogin ()
	{
			if (empty($this->data)){
				$this->error(ERROR, 'Field Empty', 'error');
				$this->redirect('User/Login', 3);
			} else {
				$return = Users::login($this->data['username'], $this->data['password']);

				if ($return['type'] == 'error') {
					Notification::error($return['msg']);
					$this->redirect('User/Login&echo', 3);
				} else if ($return['type'] == 'warning') {
					$this->redirect('User/Login&echo', 3);
					Notification::warning($return['msg']);
				} else if ($return['type'] == 'success') {
					$this->redirect('User/Profil', 3);
					Notification::success($return['msg']);
				} else {
					$this->redirect('User/login&echo', 3);
					Notification::warning('Erreur inconnu');
				}
			}
	}

	private function mailpassword ()
	{
		if (empty($this->data)) {
			$this->error(ERROR, 'Field Empty');
			$this->redirect('user/login', 3);
		} else {
			unset($this->data['send']);
			$return = $this->ModelsUser->sendEditPassword($this->data);
			$this->error('Edit mail & password', $return['msg'], $return['type']);
			$this->redirect('User', 2);
		}
	}
	public function GetUser($usermail = null, $userpass = null, $api_key = null)
	{
		if ($usermail !== null && $userpass !== null && $api_key) {
			if (defined('API_KEY')) {
				if (!empty($api_key) && $api_key == constant('API_KEY')) {
					$this->json = $this->ModelsUser->GetInfosUser($usermail, $userpass);
				}
			}
		} else {
			$this->json = null;
		}
	}
	#########################################
	# Enregistre le compte utilisateur
	#########################################
	public function sendaccount ()
	{
		$return = $this->ModelsUser->sendAccount($this->data);
		$this->error($return['title'], $return['msg'], $return['type']);
		$this->redirect('User', 2);
	}
	#########################################
	# Enregistre le compte securiter (mdp)
	#########################################
	public function sendsecurity ()
	{
		$return = $this->ModelsUser->sendSecurity($this->data);
		$this->error($return['title'], $return['msg'], $return['type']);
		$this->redirect('User', 2);
	}
	#########################################
	# Selectionne l'avatar ou le supprime
	#########################################
	public function avatarsubmit ()
	{
		$return = $this->ModelsUser->avatarSubmit($this->data);
		$this->error($return['ext'], $return['msg'], $return['type']);
		$this->redirect('User', 2);
	}
	#########################################
	# Enregistre le nouveau avatar (upload)
	#########################################
	public function newavatar ()
	{
		$return = $this->ModelsUser->sendNewAvatar($this->data);
		$this->error($return['ext'], $return['msg'], $return['type']);
		$this->redirect('User', 2);
	}
	#########################################
	# Change les liens social
	#########################################
	public function submitsocial ()
	{
		$return = $this->ModelsUser->sendSubmitSocial($this->data);
		$this->error($return['ext'], $return['msg'], $return['type']);
		$this->redirect('User', 2);
	}
}
