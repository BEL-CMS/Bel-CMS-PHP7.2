<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
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

class ModelsUser
{
	public function GetUsers ($hash_key = false)
	{
		$return = array();

		if (isset($_SESSION['pages']->user->config['MAX_USER_ADMIN'])) {
			$nbpp = (int) $_SESSION['pages']->user->config['MAX_USER_ADMIN'];
		} else {
			$nbpp = (int) 25;
		}
		$page = (GET_PAGES * $nbpp) - $nbpp;
		$sql = New BDD();
		$sql->table('TABLE_USERS');
		if ($hash_key && strlen($hash_key) == 32) {
			$where = array('name' => 'hash_key', 'value' => $hash_key);
			$sql->where($where);
		}
		$sql->orderby(array(array('name' => 'username', 'type' => 'ASC')));
		$sql->limit(array(0 => $page, 1 => $nbpp), true);
		if ($hash_key && strlen($hash_key) == 32) {
			$sql->queryOne();
		} else {
			$sql->queryAll();
		}
		$return = $sql->data;

		return $return;
	}

	public function GetUsersProfil ($hash_key = false)
	{
		$return = array();

		if ($hash_key && strlen($hash_key) == 32) {
			$sql = New BDD();
			$sql->table('TABLE_USERS_PROFILS');
			$where = array('name' => 'hash_key', 'value' => $hash_key);
			$sql->where($where);
			$sql->queryOne();
			$return = $sql->data;
		}

		return $return;
	}

	public function GetUsersSocial ($hash_key = false)
	{
		$return = array();

		if ($hash_key && strlen($hash_key) == 32) {
			$sql = New BDD();
			$sql->table('TABLE_USERS_SOCIAL');
			$where = array('name' => 'hash_key', 'value' => $hash_key);
			$sql->where($where);
			$sql->queryOne();
			$return = $sql->data;
		}

		return $return;
	}

	public function ListSocial ()
	{
		$return = array();

		$list = Common::ShowColumns(TABLE_USERS_SOCIAL);

		foreach ($list as $name) {
			if ($name != 'id' && $name != 'hash_key') {
				$return[] = $name;
			}
		}

		return $return;
	}

	public function SendEdit ($data)
	{
		$hash_key = GET_ID;
		$return   = array();

		if ($hash_key && strlen($hash_key) == 32) {
			$user = array();
			// TEST USERNAME
			$getUser = self::GetUsers($hash_key);
			if ($getUser->username != $data['username']) {
				// SQL CHECK USERNAME EXIST
				$sql = New BDD();
				$sql->table('TABLE_USERS');
				$sql->where(array('name'=>'username','value'=>$data['username']));
				$sql->count();
				$returnCheckName = (int) $sql->data;
				if ($returnCheckName >= 1) {
					$return[] = array(
						'type' => 'alert',
						'text' => 'Ce nom d\'utilisateur existe déjà.'
					);
				} else {
					$user['username'] = $data['username'];
				}
			}
			// TEST PASSWORD != EMPTY
			if (!empty($data['password'])) {
				$user['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
			}
			// TEST PRIVATE MAIL
			if ($getUser->email != $data['email']) {
				// TEST BLACKLIST MAIL
				$sql = New BDD();
				$sql->table('TABLE_MAIL_BLACKLIST');
				$sql->isObject(false);
				$sql->queryAll();
				$results = $sql->data;
				$arrayBlackList = array();
				foreach ($results as $k => $v) {
					$arrayBlackList[$v['id']] = $v['name'];
				}
				if (!empty($data['email'])) {
					$tmpMailSplit = explode('@', $data['email']);
					$tmpNdd =  explode('.', $tmpMailSplit[1]);
				}
				if (in_array($tmpNdd[0], $arrayBlackList)) {
					$return = array(
						'type' => 'alert',
						'text' => 'Les e-mails jetables ne sont pas autorisé.'
					);
				}
				// TEST MAIL VALID
				if (Secure::isMail($data['email']) === false) {
					$return = array(
						'type' => 'alert',
						'text' => 'L\'adresse e-mail n\'est pas valide.'
					);
				} else {
					$user['email'] = $data['email'];
				}
			}
			// USER ROOT
			$sql = New BDD();
			$sql->table('TABLE_USERS');
			$sql->where(array('name' => 'hash_key','value' => $hash_key));
			$sql->queryOne();
			$check = $sql->data;
			if ($check->id == 1) {
				$user['main_groups'] = (int) 1;
				if (!isset($data['groups'])) {
					$data['groups'] = (int) 2;
				} else {
					if (!in_array(1, $data['groups'])) {
						array_push($data['groups'], 1);
					}
				}
			}
			$user['main_groups'] = (int) $data['main_groups'];
			if (!isset($data['groups'])) {
				$data['groups'] = (int) 2;
			}
			$user['groups']      = implode('|', $data['groups']);
			if (empty($user['groups'])) {
				$user['groups'] = (int) 2;
			}
			// SQL UPDATE USER
			$sql = New BDD();
			$sql->table('TABLE_USERS');
			$sql->where(array('name'=>'hash_key','value' => $hash_key));
			$sql->sqlData($user);
			$sql->update();
			$userProfil = array();
			// TEST MAIL VALID
			if (!empty($data['public_mail'])) {
				if (Secure::isMail($data['public_mail']) === false) {
					$return = array(
						'type' => 'alert',
						'text' => 'L\'adresse e-mail public n\'est pas valide.'
					);
				} else {
					$userProfil['public_mail'] = $data['public_mail'];
				}
			} else {
				$userProfil['public_mail'] = '';
			}
			if (!empty($data['websites'])) {
				if (Secure::isUrl($data['websites']) === false) {
					$return = array(
						'type' => 'alert',
						'text' => $data['websites'].' n\'est pas valide'
					);
				} else {
					$userProfil['websites'] = $data['websites'];
				}
			} else {
				$userProfil['websites'] = '';
			}
			$userProfil['birthday']  = Common::transformDate($data['birthday'], false, 'Y-m-d');
			$userProfil['country']   = $data['country'];
			$userProfil['gender']    = $data['gender'];
			if (!empty($data['info_text'])) {
				$userProfil['info_text'] = Common::VarSecure($data['info_text']);
			}
			// SQL UPDATE USER PROFIL
			$sql = New BDD();
			$sql->table('TABLE_USERS_PROFILS');
			$sql->where(array('name'=>'hash_key','value' => $hash_key));
			$sql->sqlData($userProfil);
			$sql->update();
			$userSocial = array();
			foreach (self::ListSocial() as $name) {
				if (!empty($data[$name])) {
					$userSocial[$name] = Common::VarSecure($data[$name], '');
				}
			}
			// SQL UPDATE USER SOCIAL
			$sql = New BDD();
			$sql->table('TABLE_USERS_SOCIAL');
			$sql->where(array('name'=>'hash_key','value' => $hash_key));
			$sql->sqlData($userSocial);
			$sql->update();
		}
		// RETURN
		$return = array(
			'type' => 'success',
			'text' => 'Enregistrement effecté avec succès'
		);
		return $return;
	}

	public  function DelUser ($hash_key = false)
	{
		if ($hash_key && strlen($hash_key) == 32) {
			// SECURE DATA
			$del = (int) $hash_key;
			// USER ROOT
			$sql = New BDD();
			$sql->table('TABLE_USERS');
			$sql->where(array('name' => 'hash_key','value' => $hash_key));
			$sql->queryOne();
			$check = $sql->data;
			if ($check->id == 1) {
				return array(
					'type' => 'alert',
					'text' => DEL_USER_ERROR_ONE
				);
			}
			// SQL DELETE USER
			$sql = New BDD();
			$sql->table('TABLE_USERS');
			$where = array('name' => 'hash_key', 'value' => $hash_key);
			$sql->where($where);
			$sql->delete();
			// SQL RETURN NB DELETE
			if ($sql->rowCount == 1) {
				// SQL DELETE PROFILS
				unset($sql);
				$sql = New BDD();
				$sql->table('TABLE_USERS_PROFILS');
				$sql->where($where);
				$sql->delete();
				// SQL DELETE SOCIAL
				unset($sql);
				$sql = New BDD();
				$sql->table('TABLE_USERS_SOCIAL');
				$sql->where($where);
				$sql->delete();
				// RETURN
				$return = array(
					'type' => 'success',
					'text' => DEL_USER_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'alert',
					'text' => DEL_USER_ERROR
				);
			}
		} else {
			$return = array(
				'type' => 'alert',
				'text' => ERROR_NO_DATA
			);
		}
		return $return;
	}

	public function SendNew ($data = false)
	{
		if ($data !== false) {
			// TEST BLACKLIST MAIL
			$sql = New BDD();
			$sql->table('TABLE_MAIL_BLACKLIST');
			$sql->isObject(false);
			$sql->queryAll();
			$results = $sql->data;

			$arrayBlackList = array();

			foreach ($results as $k => $v) {
				$arrayBlackList[$v['id']] = $v['name'];
			}

			if (!empty($data['email'])) {
				$tmpMailSplit = explode('@', $data['email']);
				$tmpNdd =  explode('.', $tmpMailSplit[1]);
			}

			if (in_array($tmpNdd[0], $arrayBlackList)) {
				$return = array(
					'type' => 'alert',
					'text' => 'Les e-mails jetables ne sont pas autorisé.'
				);
				return $return;
			}
			// TEST EMPTY
			if (empty($data['username']) OR empty($data['email']) OR empty($data['password'])) {
				$return = array(
					'type' => 'alert',
					'text' => 'Les champs nom d\'utilisateur & e-mail & mot de passe doivent être rempli.'
				);
				return $return;
			}
			// TEST NB CHARACTERS MIN
			if (strlen($data['username']) < 4) {
				$return = array(
					'type' => 'alert',
					'text' => 'Le nom d\'utilisateur est trop court, minimum 4 caractères.'
				);
				return $return;
			}
			// TEST NB CHARACTERS MAX
			if (strlen($data['username']) > 32) {
				$return = array(
					'type' => 'alert',
					'text' => 'Le nom d\'utilisateur est trop long, maximum 32 caractères.'
				);
				return $return;
			}
			// TEST NB CHARACTERS MIN
			if (strlen($data['password']) < 6) {
				$return = array(
					'type' => 'alert',
					'text' => 'Le mot de passe est trop court, minimum 6 caractères.'
				);
				return $return;
			}
			// TEST MAIL VALID
			if (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
				$return = array(
					'type' => 'alert',
					'text' => 'L\'adresse e-mail n\'est pas valide.'
				);
				return $return;
			}
			// CHECK USERNAME EXIST
			$sql = New BDD();
			$sql->table('TABLE_USERS');
			$sql->where(array('name'=>'username','value'=>$data['username']));
			$sql->count();
			$returnCheckName = (int) $sql->data;
			if ($returnCheckName >= 1) {
				$return = array(
					'type' => 'alert',
					'text' => 'Ce nom d\'utilisateur existe déjà.'
				);
				return $return;
			}
			// CHECK MAIL EXIST
			$sql = New BDD();
			$sql->table('TABLE_USERS');
			$sql->where(array('name'=>'email','value'=>$data['email']));
			$sql->count();
			$checkMail = (int) $sql->data;
			if ($checkMail >= 1) {
				$return = array(
					'type' => 'alert',
					'text' => 'ce courriel est déjà réservé.'
				);
				return $return;
			}
			// INSERT BDD USER
			$dataUser = array(
				'username'          => $data['username'],
				'email'             => $data['email'],
				'password'          => password_hash($data['password'], PASSWORD_DEFAULT),
				'avatar'            => '/assets/imagery/default_avatar.jpg',
				'hash_key'          => md5(uniqid(rand(), true)),
				'date_registration' => date('Y-m-d H:i:s'),
				'last_visit'        => date('Y-m-d H:i:s'),
				'groups'            => (int) 2,
				'main_groups'       => (int) 2,
				'valid'             => (int) 1,
				'ip'                => '127.0.0.1',
				'token'             => ''
			);
			$insert = New BDD();
			$insert->table('TABLE_USERS');
			$insert->sqlData($dataUser);
			$insert->insert();
			// INSERT BDD PROFIL
			$dataProfils = array(
				'hash_key'     => $dataUser['hash_key'],
				'gender'       => 'unisexual',
				'public_mail'  => '',
				'websites'     => '',
				'list_ip'      => '',
				'list_avatar'  => '',
				'config'       => 0,
				'info_text'    => '',
				'birthday'     => date('Y-m-d'),
				'country'      => '',
				'hight_avatar' => '',
				'friends'      => ''
			);
			$insert = New BDD();
			$insert->table('TABLE_USERS_PROFILS');
			$insert->sqlData($dataProfils);
			$insert->insert();
			// INSERT BDD SOCIAL
			$dataSocial  = array(
				'hash_key'   => $dataUser['hash_key'],
				'facebook'   => '',
				'linkedin'   => '',
				'twitter'    => '',
				'googleplus' => '',
				'pinterest'  => ''
			);
			$insert = New BDD();
			$insert->table('TABLE_USERS_SOCIAL');
			$insert->sqlData($dataSocial);
			$insert->insert();
			// RETURN
			$return = array(
				'type' => 'success',
				'text' => 'Enregistrement effecté avec succès'
			);
			return $return;
		}
	}

	public function UpdateParameter ($data = false)
	{
		if ($data !== false) {
			// SECURE DATA
			unset($data['send']);
			$update['config'] = Common::transformOpt($data, true);
			// SQL UPDATE
			$sql = New BDD();
			$sql->table('TABLE_PAGES_CONFIG');
			$sql->where(array('name'=>'name','value' => 'user'));
			$sql->sqlData($update);
			$sql->update();
			// SQL RETURN NB UPDATE
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => NEW_PARAMETER_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'alert',
					'text' => NEW_PARAMETER_ERROR
				);
			}
		} else {
			$return = array(
				'type' => 'alert',
				'text' => ERROR_NO_DATA
			);
		}
		return $return;
	}
}
