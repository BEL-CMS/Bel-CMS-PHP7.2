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
		$dir = 'uploads/users/'.$_SESSION['USER']['HASH_KEY'].'/';
		if (!is_dir($dir)) {
		    mkdir($dir, 0777, true);
		}
		$fopen = fopen($dir.'/index.html', 'a+');
		$fclose = fclose($fopen);
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
		if (Users::isLogged() === false) {
			$this->render('login');
		} else {
			$d = array();
			$d['user'] = $this->ModelsUser->getDataUser($_SESSION['USER']['HASH_KEY']);
			$this->set($d);
			$this->render('index');
		}
	}
	public function login ()
	{
		if (Users::isLogged() === false) {
			if (!isset($_REQUEST['echo'])) {
				$this->redirect('user/login&echo', 0);
			} else {
				$this->render('login');
			}
		} else {
			$d = array();
			$d['user'] = $this->ModelsUser->getDataUser($_SESSION['USER']['HASH_KEY']);
			$this->set($d);
			$this->render('index');
		}
	}
	public function loginSecure ()
	{
		if (Users::isLogged() === false) {
			$this->redirect('user/login&echo', 0);
		} else {
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
	public function sendLostPassword ()
	{
		unset($_POST['send']);
		$return = $this->ModelsUser->checkToken($_POST);
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
	public function sendSecurelogin ()
	{
		if (isset($_REQUEST['umal']) && isset($_REQUEST['passwrd'])) {
			if (!empty($_REQUEST['umal']) && !empty($_REQUEST['passwrd'])) {

				if (Secure::isMail($_REQUEST['umal']) === false) {
					$return['text'] = 'Veuillez entrer votre e-mail';
					$return['type']	= 'warning';
					$this->error('Managements', $return['text'], $return['type']);
					$this->redirect('managements', 2);
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
						$return['text'] = 'login en cours...';
						$return['type']	= 'success';
					} else {
						$Interaction = New Interaction;
						$Interaction->user($_SESSION['USER']['HASH_KEY']);
						$Interaction->type('error');
						$Interaction->title('Accès non autorisé');
						$Interaction->text('À tenter de ce connecté avec un autre Hash Key !');
						$Interaction->insert();
						$return['text'] = 'Hash_key ne corespond pas au votre ?...';
						$return['type']	= 'danger';
					}
				} else {
					$Interaction = New Interaction;
					$Interaction->user($_SESSION['USER']['HASH_KEY']);
					$Interaction->type('error');
					$Interaction->title('Accès non autorisé');
					$Interaction->text('Tentative d\'accès avec un mauvais mot de passe !');
					$Interaction->insert();
					$return['text'] = 'Le password n\'est pas le bon !!!';
					$return['type']	= 'warning';
				}
			}
		}
		$this->error('Managements', $return['text'], $return['type']);
		$this->redirect('managements', 2);
	}
	public function sendLogin ()
	{
		if (empty($this->data)) {
			$this->error(ERROR, 'Field Empty', 'error');
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
					echo json_encode($this->json);
				}
			} else {
				echo json_encode('Error API KEY');
			}
		} else {
			echo json_encode(null);
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
		$return = $this->ModelsUser->sendNewAvatar();
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
