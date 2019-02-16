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
class Users
{
	function __construct ()
	{
		self::autoLogin();
	}
	#########################################
	# is logged true or false
	#########################################
	public static function isLogged () {
		if (isset($_SESSION['USER']['HASH_KEY']) and strlen($_SESSION['USER']['HASH_KEY']) == 32) {
			return true;
		} else {
			return false;
		}
	}
	#########################################
	# Auto connection through cookie
	#########################################
	private function autoLogin()
	{
		// Si la session existe déjà, inutile d'aller plus loin
		if (self::isLogged() === false) {
			// Control si la variable $_COOKIE existe
			if (isset($_COOKIE['BEL-CMS-COOKIE']) AND !empty($_COOKIE['BEL-CMS-COOKIE'])) {
				// Passe en tableaux les valeurs du $_COOKIE
				$cookie = explode('###', $_COOKIE['BEL-CMS-COOKIE']);
				$name   = $cookie[0]; $hash_key = $cookie[1]; $date = $cookie[2]; $hash = $cookie[3];
				// Verifie le hash_key est bien de 32 caractere
				if ($hash_key AND strlen($hash_key) == 32) {
					self::login($name, $hash, $hash_key);
				}
			}
		}
	}
	#########################################
	# login
	#########################################
	public static function login($name = null, $password = null, $hash_key = false)
	{
		$sql = New BDD();
		$sql->table('TABLE_USERS');
		$sql->isObject(false);

		// Verifie que $name & $password ne son pas vide
		if (!empty($name) AND !empty($password)) {
			// Connexion par mail, name ou seulement par hash_key
			if ($hash_key AND strlen($hash_key) == 32) {
				$hash_key_search = array(
					'name'  => 'hash_key',
					'value' => $hash_key
				);
			} else {
				$hash_key_search = null;
			}
			if (strpos($name, '@')) {
				$request = 'email';
			} else {
				$request = 'username';
			}

			$sql->where(
				array(
					'name'  => $request,
					'value' => $name
				), $hash_key_search
			);

			$sql->queryOne();

			$results = $sql->data;

			if ($results && is_array($results) && sizeof($results)) {
				if ($hash_key AND strlen($hash_key) == 32) {
					$check_password = $password == $results['password'] ? true : false;
				} else {
					$check_password = false;
				}
				if (password_verify($password, $results['password']) OR $check_password) {
					$setcookie = $results['username'].'###'.$results['hash_key'].'###'.date('Y-m-d H:i:s').'###'.$results['password'];
					setcookie('BEL-CMS-COOKIE', $setcookie, time()+60*60*24*30, '/');
					$_SESSION['USER']['HASH_KEY'] = $results['hash_key'];
					$return['msg']  = 'La connexion a été éffectuée avec succès';
					$return['type'] = 'success';
				} else {
					$return['msg']  = 'Mauvaise combinaison de Pseudonyme-email et/ou mot de passe';
					$return['type'] = 'error';
				}
			} else {
				$return['msg']  = 'Aucun utilisateur avec ce Pseudonyme/mail';
				$return['type'] = 'warning';
			}
		} else {
			$return['msg']  = 'Le nom ou le mot de passe est obligatoire';
			$return['type'] = 'error';
		}
		return $return;
	}
	#########################################
	# Get infos user by id
	#########################################
	public static function getInfosUser($hash_key = null)
	{
		if ($hash_key !== null && strlen($hash_key) == 32) {
			$sql = New BDD();
			$sql->table('TABLE_USERS');
			$sql->where(array(
				'name'  => 'hash_key',
				'value' => $hash_key
			));
			$sql->queryOne();

			if (!empty($sql->data)) {
				$return[$sql->data->hash_key] = $sql->data;
				unset($return[$sql->data->hash_key]->password, $return[$sql->data->hash_key]->hash_key);
			} else {
				return (object) array();
			}
		} else {
			return (object) array();
		}

		return $return;

	}
	#########################################
	# Logout
	#########################################
	public static function logout()
	{
		unset($_SESSION['USER']);
		setcookie('BEL-CMS-COOKIE', NULL, -1, '/');
		$return['msg']  = 'Votre session est vos cookie de ce site sont effacés';
		$return['type'] = 'success';
		return $return;
	}
	#########################################
	# Verifie si l'utilisateur existe
	#########################################
	public static function ifUserExist ($hash_key = null)
	{
		$return = false;

		if ($hash_key !== null && strlen($hash_key) == 32) {
			$sql = New BDD();
			$sql->table('TABLE_USERS');
			$sql->where(array(
				'name'  => 'hash_key',
				'value' => $hash_key
			));
			$sql->count();
			$return = $sql->data;
			if (!empty($return)) {
				$return = true;
			}
		}

		return $return;
	}
}
