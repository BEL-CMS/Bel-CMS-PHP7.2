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

class ModelsUser
{
	#####################################
	# Variable declaration
	#####################################
	private $sql;
	private $structureUser = array(
		'id',
		'username',
		'password',
		'email',
		'hash_key',
		'date_registration',
		'last_visit',
		'groups',
		'main_groups',
		'valid',
		'ip',
		'token',
		'avatar'
	);
	private $structureProfils = array(
		'id',
		'hash_key',
		'gender',
		'public_mail',
		'websites',
		'list_ip',
		'config',
		'info_text',
		'birthday',
		'country',
		'hight_avatar',
		'friends'
	);
	#####################################
	# Get data table users
	#####################################
	public function getDataUser ($hash_key = false)
	{
		if (Users::isLogged() === true) {
			if ($hash_key and ctype_alnum($hash_key)) {

				$this->sql = New BDD();
				$this->sql->table('TABLE_USERS');
				$this->sql->isObject(false);
				$this->sql->where(array(
					'name'  => 'hash_key',
					'value' => $hash_key
				));
				$this->sql->queryOne();
				$results = $this->sql->data;

				if ($results && sizeof($results)) {
					$this->sqlP = New BDD();
					$this->sqlP->table('TABLE_USERS_PROFILS');
					$this->sqlP->isObject(false);
					$this->sqlP->where(array(
						'name'  => 'hash_key',
						'value' => $hash_key
					));
					$this->sqlP->queryOne();
					$resultsProfils = $this->sqlP->data;
				}
				$returnMerge = array_merge($results, $resultsProfils);
				if ($returnMerge && sizeof($returnMerge)) {

					$this->sqlS = New BDD();
					$this->sqlS->table('TABLE_USERS_SOCIAL');
					$this->sqlS->isObject(false);
					$this->sqlS->where(array(
						'name'  => 'hash_key',
						'value' => $hash_key
					));
					$this->sqlS->queryOne();
					$resultsSocial = $this->sqlS->data;
				}

				if (!empty($resultsSocial)) {
					$returnMerge = array_merge($returnMerge, $resultsSocial);
				}

				if (!empty($returnMerge)) {
				
					foreach ($returnMerge as $k => $v) {
						if ($k == 'birthday') {
							$v = Common::transformDate($v, 'SHORT');
						} else if ($k == 'date_registration' OR $k == 'last_visit') {
							$v = Common::TransformDate($v, 'SHORT', 'SHORT');
						}
						if ($k == 'avatar') {
							if (empty($v) OR !is_file($v)) {
								$v = 'assets/images/default_avatar.jpg';
							}
						}
						if ($k == 'friends') {
							if (empty($v)) {
								$v = array();
							} else {
								$arrayHash = explode('|', $v);
								/*
								foreach ($arrayHash as $k_h => $v_h) {
									$returnMerge[$k][$v_h]['name'] = Users::hashkeyToUsernameAvatar($v_h);
									$returnMerge[$k][$v_h]['avatar'] = Users::hashkeyToUsernameAvatar($v_h, 'avatar');
								}

								/*
								$returnInfosUser = Users::getInfosUser($arrayHash);
								$v = array();
								foreach ($returnInfosUser as $keyTmp => $valueTmp) {
									$v[$keyTmp]['name']   = $valueTmp->name;
									$v[$keyTmp]['avatar'] = $valueTmp->avatar;
									if (empty($v[$keyTmp]['avatar']) OR !is_file($v[$keyTmp]['avatar'])) {
										$v[$keyTmp]['avatar'] = 'assets/imagery/default_avatar.jpg';
									}
								}
								*/
							}
						}

						if ($k == 'gender') {
							$v = strtoupper($v);
							$v = defined($v) ? constant($v) : $v;
						}

						if ($k == 'groups') {
							$v = explode('|', $v);
							$v = is_array($v) ? $v : (array) $v;
						}

						if ($k == 'main_groups') {
							$v = (int) $v;
						}

		/*
						if (!is_array($v)) {
							$return[$k] = empty($v) ? UNKNOWN : $v;
						} else {
							$return[$k] = $v;
						}
		*/
						$return[$k] = $v;
						$directoryAvatar = ROOT.'uploads/users/'.$hash_key;

						if (!file_exists($directoryAvatar)) {
							if (!mkdir($directoryAvatar, 0777, true)) {
								throw new Exception('Failed to create directory');
							} else {
								$fopen = fopen($directoryAvatar.'/index.html', 'a+');
								$fclose = fclose($fopen);
							}
						}
					}
					$return['list_avatar'] = array();
					$getListAvatar = Common::scanFiles('uploads/users/'.$hash_key.'/', array('gif', 'jpg', 'jpeg', 'png'), true);
					foreach ($getListAvatar as $valueListAvatar) {
						$return['list_avatar'][] = $valueListAvatar;
					}
				} else {
					$return = array();
				}

			} else {
					$this->sqlU = New BDD();
					$this->sqlU->table('TABLE_USERS');
					$this->sqlU->isObject(false);
					$this->sqlU->where(array(
						'name'  => 'hash_key',
						'value' => $hash_key
					));
					$this->sqlU->queryAll();
					$results = $this->sqlU->data;

				if ($results && sizeof($results)) {
					$hashKeyRequest = array();

					$this->sqlUS = New BDD();
					$this->sqlUS->table('TABLE_USERS_PROFILS');
					$this->sqlUS->isObject(false);
					$this->sqlUS->where(array(
						'name'  => 'hash_key',
						'value' => $v['hash_key']
					));
					$this->sqlUS->queryAll();
					$resultsProfils = $this->sqlUS->data;

					$arrayProfils   = array();

					foreach ($resultsProfils as $k => $v) {
						$arrayProfils[$v['hash_key']] = $v;
					}

					$arraySocial   = array();

					foreach ($resultsSocial as $k => $v) {
						$arraySocial[$v['hash_key']] = $v;
						unset($arraySocial[$v['hash_key']]['hash_key'], $arraySocial[$v['hash_key']]['id']);
					}

					$i = 0;
					foreach ($results as $k => $v) {
						if (array_key_exists($v['hash_key'], $arrayProfils)) {
							$return[$i] = array_merge($results[$k], $arrayProfils[$v['hash_key']]);
						}
						if (array_key_exists($v['hash_key'], $arraySocial)) {
							$return[$i] = array_merge($return[$i], $arraySocial[$v['hash_key']]);
						} $i++;
					}

					foreach ($return as $k => $v) {
						$return[$k]['gender']            = defined($v['gender']) ? constant(strtoupper($v['gender'])) : $v['gender'];
						$return[$k]['birthday']          = Common::transformDate($return[$k]['birthday']);
						$return[$k]['date_registration'] = Common::transformDate($return[$k]['date_registration'], true);
						$return[$k]['last_visit']        = Common::transformDate($return[$k]['last_visit'], true);
						if (empty($return[$k]['avatar']) or !is_file($return[$k]['avatar'])) {
							$return[$k]['avatar'] = 'assets/imagery/default_avatar.jpg';
						}
						$return[$k]['groups'] = explode('|', $v['groups']);
						$return[$k]['main_groups'] = (int) $v['main_groups'];
					}

				}
			}
		} else {
			return false;
		}
		return (object) $return;
	}
	#####################################
	# Insert registration
	#####################################
	public function sendRegistration (array $data)
	{

		if ($data) {
			$error = null;
			// Ajout du blacklistage des mail jetables
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

			foreach ($data as $k => $v) {
				if (!array_search($k, $this->structureUser)) {
					if ($k != 'name') {
						unset($data[$k]);
					}
				}
			}

			if (empty($data['username']) OR empty($data['email']) OR empty($data['password'])) {
				$return['msg']  = 'Les champs nom d\'utilisateur & e-mail & mot de passe doivent être rempli'; ++$error;
				$return['type']  = 'error';
			} else if (in_array($tmpNdd[0], $arrayBlackList)) {
				$return['msg']  = 'Les e-mails jetables ne sont pas autorise'; ++$error;
				$return['type']  = 'warning';
			} else if ($_REQUEST['query_register'] != $_SESSION['TMP_QUERY_REGISTER']['OVERALL'])  {
				$return['msg']  = 'Le code de sécurité est incorrect'; ++$error;
				$return['type']  = 'warning';
			} else if (strlen($data['username']) < 4) {
				$return['msg']  = 'Le nom d\'utilisateur est trop court, minimum 4 caractères'; ++$error;
				$return['type']  = 'warning';
			} else if (strlen($data['username']) > 32) {
				$return['msg']  = 'Le nom d\'utilisateur est trop long, maximum 32 caractères'; ++$error;
				$return['type']  = 'warning';
			} else if (strlen($data['password']) < 6) {
				$return['msg']  = 'Le mot de passe est trop court, minimum 6 caractères'; ++$error;
				$return['type']  = 'warning';
			} else if ($data['password'] != $_POST['passwordrepeat']) {
				$return['msg']  = 'Le mot de passe et la confirmation ne sont pas identiques'; ++$error;
				$return['type']  = 'warning';
			}

			if ($error === null) {

				$sql = New BDD();
				$sql->table('TABLE_USERS');
				$sql->where(array('name'=>'username','value'=>$data['username']));
				$sql->count();
				$returnCheckName = (int) $sql->data;

				$sql = New BDD();
				$sql->table('TABLE_USERS');
				$sql->where(array('name'=>'email','value'=>$data['email']));
				$sql->count();
				$checkMail = (int) $sql->data;

				if ($returnCheckName >= 1) {
					$return['msg']  = 'ce Nom / Pseudo est déjà réservé.';
					$return['type']  = 'warning';
				} elseif ($checkMail >= 1) {
					$return['msg']  = 'ce courriel est déjà réservé.';
					$return['type']  = 'warning';
				} else {
					$data['avatar']            = '';
					$data['password']          = password_hash($data['password'], PASSWORD_DEFAULT);
					$data['hash_key']          = md5(uniqid(rand(), true));
					$data['date_registration'] = date('Y-m-d H:i:s');
					$data['last_visit']        = date('Y-m-d H:i:s');
					$data['groups']            = (int) 2;
					$data['main_groups']       = (int) 2;
					$data['valid']             = (int) 1;
					$data['ip']                = Common::getIp();
					$data['token']             = '';

					$insert = New BDD();
					$insert->table('TABLE_USERS');
					$insert->sqlData($data);
					$insert->insert();

					$dataProfils = array(
						'hash_key'     => $data['hash_key'],
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

					$insert = New BDD();
					$insert->table('TABLE_USERS_SOCIAL');
					$insert->sqlData(array('hash_key'=> $data['hash_key']));
					$insert->insert();

					unset($_SESSION['TMP_QUERY_REGISTER']);

					Users::login($_POST['username'],$_POST['password']);

					$return['msg']      = 'Enregistrement en cours...';
					$return['type']     = 'success';
				}
			}
			return $return;
		}
	}
	public function sendEditProfil ($data) {
		$error  = true;
		$insertProfil = array();
		/*
		if ($data['username'] != $_SESSION['user']->username) {
			if (strlen($data['username']) < 4) {
				$return['msg']  = 'Pseudo trop court, minimum 4 caractères'; ++$error;
				$return['type'] = 'red';
			} else if (strlen($data['username']) > 32) {
				$return['msg']  = 'Pseudo trop long, maximum 32 caractères'; ++$error;
				$return['type'] = 'red';
			}
			$sql = New BDD();
			$sql->table('TABLE_USERS');
			$sql->where(array('name'=>'username','value'=>$data['username']));
			$sql->count();
			$returnCheckName = (int) $sql->data;

			if ($returnCheckName >= 1) {
				$return['msg']  = 'ce Nom / Pseudo est déjà réservé.'; ++$error;
				$return['type'] = 'blue';
			} else {
				# update data sql table user
				$sql = New BDD();
				$sql->table('TABLE_USERS');
				$sql->where(array('name'=>'hash_key','value'=>$_SESSION['USER']['HASH_KEY']));
				$sql->sqlData(array('name' => $data['username']));
				$sql->update();
				$countRowUpdate = $sql->data;
			}
		}
		*/

		if ($error && !empty($data['birthday']) && strlen($data['birthday']) == 10) {
			$insertProfil['birthday'] = Common::DatetimeSQL($data['birthday'], false, 'Y-m-d');
		} else if ($error && empty($data['birthday'])) {
			$insertProfil['birthday'] = '0000-00-00';
		}
		if ($error && !filter_var($data['websites'], FILTER_VALIDATE_URL)) {
			$return['msg']  = $data['websites'].' n\'est pas valide'; ++$error;
			$return['type'] = 'red';
		} else {
			$insertProfil['websites'] = $data['websites'];
		}
		if ($error && !empty($data['country'])) {
			if (in_array($data['country'], Common::contryList())) {
				$insertProfil['country'] = $data['country'];
			}
		}

		if ($error && !empty($data['gender'])) {
			if ($data['gender'] == 'male') {
				$insertProfil['gender'] = 'male';
			} else if ($data['gender'] == 'female') {
				$insertProfil['gender'] = 'female';
			} else {
				$insertProfil['gender'] = 'unisexual';
			}
		} else {
			$insertProfil['gender'] = 'unisexual';
		}

		if (!empty($_FILES['hight_avatar'])) {
			$dir = 'uploads/'.$_SESSION['USER']['HASH_KEY'].'/';
			$extensions = array('.png', '.gif', '.jpg', '.jpeg');
			$extension = strrchr($_FILES['hight_avatar']['name'], '.');
			if (!in_array($extension, $extensions)) {
				$return['msg']  = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg'; ++$error;
				$return['type'] = 'red';
			}
			if (move_uploaded_file($_FILES['hight_avatar']['tmp_name'], $dir.'hight_avatar.png')) {
				$insertProfil['hight_avatar'] = $dir.'hight_avatar.png';
			} else {
				$return['msg']  = 'Echec de l\'upload !'; ++$error;
				$return['type'] = 'blue';
			}
		}
		$insertProfil['info_text'] = Common::VarSecure($data['info_text'], null);
		$insertProfil['info_text'] = empty($insertProfil['info_text']) ? '<p></p>' : $insertProfil['info_text'];

		$sql = New BDD();
		$sql->table('TABLE_USERS_PROFILS');
		$sql->where(array('name'=>'hash_key','value'=> $_SESSION['USER']['HASH_KEY']));
		$sql->sqlData($insertProfil);
		$sql->update();
		$countRowUpdate = $sql->rowCount;

		if ($countRowUpdate != 0) {
			$return['msg']  = 'Vos informations ont été sauvegardées avec succès';
			$return['type'] = 'success';
		} else {
			$return['msg']  = 'Vos informations n\'ont pas été sauvegardées ou partiellement';
			$return['type'] = 'warning';
		}

		return $return;
	}
	public function sendEditSocial ($data) {

		$update = New BDD();
		$update->table('TABLE_USERS_SOCIAL');
		$update->sqlData($data);
		$update->where(array(
			'name'  => 'hash_key',
			'value' => $_SESSION['USER']['HASH_KEY']
		));
		$update->update();
		$returnSql = $update->data;
		$resultsCount = $returnSql;

		if ($resultsCount != null) {
			$return['msg']      = 'Vos informations ont été sauvegardées avec succès';
			$return['type']     = 'success';
			$return['rowcount'] = $resultsCount;
		} else {
			$return['msg']  = 'Aucune informations a été sauvegardées';
			$return['type'] = 'danger';
			$return['rowcount'] = $resultsCount;
		}
		return $return;

	}
	public function sendEditPassword ($data) {
		$insertUser   = array();
		$insertProfil = array();
		$error        = true;

		$sql = New BDD();
		$sql->table('TABLE_USERS');
		$sql->where(array('name'=>'hash_key','value'=>$_SESSION['USER']['HASH_KEY']));
		$sql->queryOne();
		$results = $sql->data;

		$sql = New BDD();
		$sql->table('TABLE_MAIL_BLACKLIST');
		$sql->queryAll();
		$resultsBlackList = $sql->data;

		$arrayBlackList   = array();
		foreach ($resultsBlackList as $k => $v) {
			$arrayBlackList[$v->id] = $v->name;
		}

		if (!empty($data['newpassword'])) {
			if (password_verify($data['password'], $results->password)) {
				$insertUser['password'] = password_hash($data['newpassword'], PASSWORD_DEFAULT);
			} else {
				$return['msg']  = 'Le mot de passe ne correspondent pas avec celui du compte'; ++$error;
				$return['type'] = 'danger';
			}
		}

		if ($error && $data['email'] != $results->email) {

			if (!empty($data['email'])) {
				$tmpMailSplit = explode('@', $data['email']);
				$tmpNdd =  explode('.', $tmpMailSplit[1]);
			}

			if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
				$return['msg']  = 'le courriel '.$data['private_mail'].' n\'est pas valide';
				$return['type'] = 'danger';
			} else if (in_array($tmpNdd[0], $arrayBlackList)) {
				$return['msg']  = 'Les faux mails ne sont pas autorisés';
				$return['type'] = 'danger';
			} else {
				$insertUser['email'] = $data['email'];
			}
		}

		$sql = New BDD();
		$sql->table('TABLE_USERS_PROFILS');
		$sql->where(array('name'=>'hash_key','value'=>$_SESSION['USER']['HASH_KEY']));
		$sql->queryOne();
		$resultsProfils = $sql->data;

		if ($error && !empty($data['public_mail'])) {
			if (!empty($data['public_mail'])) {
				$tmpMailSplit = explode('@', $data['public_mail']);
				$tmpNdd =  explode('.', $tmpMailSplit[1]);
			}

			if (!empty($data['public_mail'])) {
				$tmpMailSplit = explode('@', $data['public_mail']);
				$tmpNdd = explode('.', $tmpMailSplit[1]);
			}

			if (!filter_var($data['public_mail'], FILTER_VALIDATE_EMAIL)) {
				$return['msg']  = 'le courriel '.$data['public_mail'].' n\'est pas valide';
				$return['type'] = 'error';
			} else if (in_array($tmpNdd[0], $arrayBlackList)) {
				$return['msg']  = 'Les faux mails ne sont pas autorisés';
				$return['type'] = 'error';
			} else {
				$sql = New BDD();
				$sql->table('TABLE_USERS_PROFILS');
				$sql->where(array('name'=>'hash_key','value'=>$_SESSION['USER']['HASH_KEY']));
				$sql->sqlData(array('public_mail' => $data['public_mail']));
				$sql->update();
				$resultsProfils = $sql->data;
			}
		} else if (empty($data['public_mail'])) {
			$sql = New BDD();
			$sql->table('TABLE_USERS_PROFILS');
			$sql->where(array('name'=>'hash_key','value'=>$_SESSION['USER']['HASH_KEY']));
			$sql->sqlData(array('public_mail' => ''));
			$sql->update();
		}
		if ($error && count($insertUser) > 0) {
			$sql = New BDD();
			$sql->table('TABLE_USERS');
			$sql->where(array('name'=>'hash_key','value'=>$_SESSION['USER']['HASH_KEY']));
			$sql->sqlData($insertUser);
			$sql->update();
			$resultsProfils = $sql->data;
		}

		if ($error) {
			$return['msg']  = 'Vos informations ont été sauvegardées avec succès';
			$return['type'] = 'success';
		}

		return $return;
	}
	public function sendChangeAvatar ($data = false)
	{
		$rowCount = null;
		if ($data) {
			$a = array('?ajax', '?jquery', '?echo');
			$data = str_replace($a, '', $data);
			$dir = 'uploads/users/'.$_SESSION['USER']['HASH_KEY'].'/';
			$checkdir = strpos($data, $dir);
			if ($checkdir !== false) {
				$sql = New BDD();
				$sql->table('TABLE_USERS');
				$sql->where(array('name'=>'hash_key','value'=>$_SESSION['USER']['HASH_KEY']));
				$sql->sqlData(array('avatar'=> $data));
				$sql->update();
			}
		}
		if ($sql->rowCount == 0) {
			$return['msg']  = 'Erreur de changement d\'image';
			$return['type'] = 'warning';
		} else if ($sql->rowCount == 1) {
			$return['msg']  = 'Changement d\'image effectué avec succès';
			$return['type'] = 'success';
		} else {
			$return['msg'] = ERROR;
			$return['type'] = 'error';
		}
		return $return;
	}
	public function sendDeleteAvatar ($data = false)
	{
		if ($data) {
			$dir = 'uploads/users/'.$_SESSION['USER']['HASH_KEY'].'/';
			$checkdir = strpos($data, $dir);
			if ($checkdir !== false) {
				unlink($data);
				$return['msg']  = 'Effacés avec succès';
				$return['type'] = 'success';
			} else {
				$return['msg']  = 'Le dossier ne vous appartient pas !';
				$return['type'] = 'error';
			}
		} else {
			$return['msg']  = 'Aucune données';
			$return['type'] = 'warning';
		}
		return $return;
	}
	#####################################
	# Generator password 8 default
	#####################################
	public static function generatePass ($height = 6){
		// initialiser la variable $return
		$return = '';
		// Définir tout les caractères possibles dans le mot de passe,
		$character = "#'/*-&@$%2346789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		// obtenir le nombre de caractères dans la chaîne précédente
		$max = strlen($character);
		if ($height > $max) {
			$height = $max;
		}
		// initialiser le compteur
		$i = 0;
		// ajouter un caractère aléatoire à $return jusqu'à ce que $height soit atteint
		while ($i < $height) {
			// prendre un caractère aléatoire
			$letter = substr($character, mt_rand(0, $max-1), 1);
			// vérifier si le caractère est déjà utilisé dans $mdp
			if (!stristr($return, $character)) {
				// Si non, ajouter le caractère à $return et augmenter le compteur
				$return .= $letter;
				$i++;
			}
		}
		// retourner le résultat final
		return $return;
	}
	#####################################
	# Check token and send mail
	#####################################
	public function checkToken($data = false)
	{
		if ($data) {
			if (strpos($data['value'], '@')) {
				$type = 'email';
			} else {
				$type = 'username';
			}

			/*
			$check =    array(
				'table'      => TABLE_USERS,
				'where'      => array(
					 'name'  => $type,
					 'value' => $data['value']
				)
			);
			$results = BDD::getInstance()->select($check, false);
			*/

			$sql = New BDD();
			$sql->table('TABLE_USERS');
			$sql->where(array('name'=>$type,'value'=>$data['value']));
			$sql->isObject(false);
			$sql->queryOne();
			$results = $sql->data;

			if ($results && is_array($results) && sizeof($results)) {
				if (empty($results['token'])) {
					// Création du token
					$hashToken = md5(uniqid(rand(), true));
					$timeToken = time() + 60*60;
					$token = $hashToken.'|'.$timeToken;

					$sql = New BDD();
					$sql->table('TABLE_USERS');
					$sql->sqlData(array('token' => $token));
					$sql->where(array('name' => $type,'value'=> $data['value']));
					$sql->update();
					// Contenue du courriel
					$contentMail = '';
					$contentMail .= '<p>Token : <strong>' . $hashToken . '</strong></p>';
					$contentMail .= '<p>Valable : 1h00</p>';
					$mail = array(
						'subject'  => 'Demande de nouveau mot de passe',
						'content'  => self::contentMail('Token', $contentMail),
						'sendMail' => $results['email']
					);
					$returnMail = Common::sendMail($mail);
					if ($returnMail) {
						$dataAction = array(
							'name'        => '',
							'ip'          => Common::getIp(),
							'date_insert' => date('Y-m-d H:i:s'),
							'text'        => 'Une demande de regénération de mot de passe à été demander',
							'modules'     => 'User'
						);

						$return['msg']  = 'Un mail avec un token a été génère et envoyé par courriel';
						$return['type'] = 'success';
					} else {
						$return['msg']  = 'Le mail n\'a pas pu être envoyé, veuillez-vous référer à l\'administrateur du site';
						$return['type'] = 'error';
					}
				} else {
					$explode = explode('|', $results['token']);
					if ($explode[1] <= time()) {
						// Reset du token
						$sql = New BDD();
						$sql->table('TABLE_USERS');
						$sql->where(array('name'=>'token','value'=>$token));
						$sql->sqlData(array('token'=>''));
						$sql->where(array('name' => $type,'value'=> $data['value']));
						$sql->update();
						self::checkToken($data['value']);
						$return['msg']  = 'Ce token n\'est plus valide, un nouveau a été génère';
						$return['type'] = 'blue';
					} else {
						if (empty($data['token'])) {
							$return['msg']  = 'Votre token est valide, veuillez l\'utiliser';
							$return['type'] = 'error';
						} else if ($data['token'] != $explode[0]) {
							$dataAction = array(
								'name'        => '',
								'ip'          => Common::getIp(),
								'date_insert' => date('Y-m-d H:i:s'),
								'text'        => 'Le token de correspondais pas avec celui du compte',
								'modules'     => 'User'
							);
							$return['msg']  = 'Ce token ne correspond pas avec celui du compte';
							$return['type'] = 'error';
						} else {
							$generatePass = self::generatePass(8);
							$password = password_hash($generatePass, PASSWORD_DEFAULT);
							// Update du mot de passe & reset du token
							$sql = New BDD();
							$sql->table('TABLE_USERS');
							$sql->sqlData(array('password'=>$password,'token'=>''));
							$sql->where(array('name' => $type,'value'=> $data['value']));
							$sql->update();

							$contentMail = '';
							$contentMail .= '<p>Votre mot de passe  : <strong>' . $generatePass . '</strong></p>';
							$mail = array(
								'name'     => CMS_WEBSITE_NAME,
								'mail'     => CMS_MAIL_WEBSITE,
								'subject'  => 'Demande de nouveau mot de passe',
								'content'  => self::contentMail('Mot de passe', $contentMail),
								'sendMail' => $results['email']
							);

							$returnMail = Common::sendMail($mail);

							$return['msg']  = 'Voici votre nouveau mot de passe : '. $generatePass;
							$return['type'] = 'success';
							$return['pass'] = true;
						}
					}
				}
			} else {
				$return['msg']  = 'Aucun Nom et/ou pseudo connu';
				$return['type'] = 'error';
			}
		} else {
			$return['msg']  = 'Nom et/ou pseudo vide';
			$return['type'] = 'error';
		}
		return $return;
	}
	#####################################
	# Content mail
	#####################################
	public static function contentMail($title, $content)
	{
		$return = '	<html>
						<body>
							<div>
								<table align="center" style="background:#efefef;width:90%;border: 1px solid #6f6e70; margin:0 auto;" border="0" cellspacing="0" cellpadding="0">
									<tr style="background:#28a1db;color:#FFFFFF;text-align:center;font-size:16px;line-height: 30px;">
										<td><strong>'.$title.'</strong></td>
									</tr>
									<tr style="margin-top:5px;margin-bottom:5px;"><td>
										<table align="center" style="width:90%; line-height:24px; padding:5px; margin:15px auto;" border="0" cellspacing="0" cellpadding="0">
											<tr style="color:#28a1db"><td>'.$content.'</td></tr>
										</table>
									</td></tr>
									<tr style="margin-top:5px;margin-bottom:5px;"><td>
										<table align="center" style="width:85%; line-height:24px; padding:5px; border-radius:3px; margin:15px auto;border:1px solid #DADADA" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td style="text-align: center;"><strong>Ip:</strong></td>
												<td>'.Common::getIp().'</td>
												<td><strong>Heure:</strong></td>
												<td>'.date('d-m-Y H:i:s').'</td>
											</tr>
										</table>
									</td></tr>
									<tr style="background:#6f6e70;text-align:center;border-top:1px solid #ccc; font-size:16px;line-height: 30px"></tr>
								</table>
							</div>
						</body>
					</html> ';
		return $return;
	}
	public function GetInfosUser ($usermail = null, $userpass = null)
	{
		$return = false;

		if ($usermail !== null && $userpass !== null) {
			if (Secure::IsMail($usermail) === false) {
				return false;
			}
			if (Secure::isString($userpass) === false) {
				return false;
			}

			$sql = New BDD();
			$sql->table('TABLE_USERS');
			$sql->where(
				array(
					'name'  => 'email',
					'value' => $usermail
				)
			);
			$sql->queryOne();
			$results = $sql->data;

			if ($sql->rowCount == 1) {
				if (password_verify($userpass, $results->password)) {
					$json = (object) array();
					$json->getBrowserType = 'Android';
					$json->hash_key = $results->hash_key;
					self::addLastVisit($results->hash_key);
					new Visitors($json);
					$return = $results;
				}
			} else {
				return false;
			}
		}

		return $return;
	}
	#########################################
	# Ajoute une visite
	#########################################
	private function addLastVisit ($hash_key = null)
	{
		if (strlen($hash_key) == 32) {
			$sql = New BDD();
			$sql->table('TABLE_USERS');
			$sql->where(array('name' => 'hash_key', 'value' => $hash_key));
			$sql->sqlData(array('last_visit' => date('Y-m-d H:i:s'), 'ip' => Common::GetIp()));
			$sql->update();
		}
	}
	#########################################
	# Enregistre les parametres du compte 
	#########################################
	public function sendAccount ($data)
	{
		if (!empty($data)) {
			if (strlen($_SESSION['USER']['HASH_KEY']) == 32) {
				$sql = New BDD();
				$sql->table('TABLE_USERS');
				$sql->where(array('name' => 'hash_key', 'value' => $_SESSION['USER']['HASH_KEY']));
				$sql->queryOne();
				$dataUser = $sql->data;
				if (empty($sql->data)) {
					$return = array('type' => 'warning', 'msg' => 'Erreur de données utilisateur', 'title' => 'Données');
					return $return;
				} else {
					if ($dataUser->hash_key != $_SESSION['USER']['HASH_KEY']) {
						$return = array('type' => 'error', 'msg' => 'La hash key ne vous appartient pas', 'title' => 'Hash Key');
						// TODO : faire un systeme de prévention 
						return $return;
					} else {

						if ($data['username'] != $dataUser->username) {
							$sql = New BDD();
							$sql->table('TABLE_USERS');
							$sql->where(array('name' => 'username', 'value' => $data['username']));
							$sql->count();
							if ($sql->data == 1) {
								$return = array('type' => 'error', 'msg' => 'Ce nom d\'utilisateur est déjà utilisé', 'title' => 'Pseudo');
								return $return;	
							} else {
								$dataInsert['username'] = $data['username'];
							}
						}

						if ($data['mail'] != $dataUser->email) {
							$sql = New BDD();
							$sql->table('TABLE_USERS');
							$sql->where(array('name' => 'email', 'value' => $data['mail']));
							$sql->count();
							if ($sql->data == 1) {
								$return = array('type' => 'error', 'msg' => 'Cette email priver est déjà utilisé', 'title' => 'Email');
								return $return;	
							} else {
								$dataInsert['email'] = $data['mail'];
							}
						}

						if (!empty($dataInsert)) {
							$sql = New BDD();
							$sql->table('TABLE_USERS');
							$sql->where(array('name' => 'hash_key', 'value' => $_SESSION['USER']['HASH_KEY']));
							$sql->sqlData($dataInsert);
							$sql->update();
						}

						$dataInsertProfils['birthday'] = $data['birthday'];
						$dataInsertProfils['country']  = Secure::isString($data['country']);
						$dataInsertProfils['websites'] = Secure::isUrl($data['websites']);
						$dataInsertProfils['gender']   = Secure::isString($data['gender']);

						$sql = New BDD();
						$sql->table('TABLE_USERS_PROFILS');
						$sql->where(array('name' => 'hash_key', 'value' => $_SESSION['USER']['HASH_KEY']));
						$sql->sqlData($dataInsertProfils);
						$sql->update();

						$return = array('type' => 'success', 'msg' => 'Tout les paramètre, on été enregistré', 'title' => 'Profil');
						return $return;
					}
				}
			} else {

				$return = array('type' => 'error', 'msg' => 'Erreur de Key', 'title' => 'Profil');
				return $return;
			}
		} else {
			$return = array('type' => 'error', 'msg' => 'Aucune données', 'title' => 'Profil');
			return $return;
		}
	}
	#########################################
	# Enregistre un nouveau mot de passe
	#########################################
	public function sendSecurity ($data)
	{
		$sql = New BDD();
		$sql->table('TABLE_USERS');
		$sql->where(array('name' => 'hash_key', 'value' => $_SESSION['USER']['HASH_KEY']));
		$sql->queryOne();
		$results = $sql->data;
		if (password_verify($data['password_old'], $results->password)) {
			$insert['password'] = password_hash($data['password_new'], PASSWORD_DEFAULT);
			$sql = New BDD();
			$sql->table('TABLE_USERS');
			$sql->where(array('name' => 'hash_key', 'value' => $_SESSION['USER']['HASH_KEY']));
			$sql->sqlData($insert);
			$sql->update();

			setcookie('BEL-CMS-COOKIE', NULL, -1, '/');
			$setcookie = $results->username.'###'.$_SESSION['USER']['HASH_KEY'].'###'.date('Y-m-d H:i:s').'###'.$insert['password'];
			setcookie('BEL-CMS-COOKIE', $setcookie, time()+60*60*24*30, '/');

			$return = array('type' => 'success', 'msg' => 'Le mot de passe a été enregistré', 'title' => 'Mot de passe');
			return $return;
		} else {
			$return = array('type' => 'error', 'msg' => 'L\'ancien mot de passe de conrespond pas', 'title' => 'Mot de passe');
			return $return;
		}
	}
	#########################################
	# Enregistre le nouveau avatar (upload)
	#########################################
	public function sendNewAvatar ()
	{
		if (!empty($_FILES['avatar'])) {
			$dir = 'uploads/users/'.$_SESSION['USER']['HASH_KEY'].'/';
			$extensions = array('.png', '.gif', '.jpg', '.jpeg');
			$extension = strrchr($_FILES['avatar']['name'], '.');
			if (!in_array($extension, $extensions)) {
				$return['msg']  = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg';
				$return['type'] = 'error';
				$return['ext']  = 'Extention';
 			} else if (move_uploaded_file($_FILES['avatar']['tmp_name'], $dir.$_FILES['avatar']['name'])) {
				$return['msg']  = 'Upload effectué avec succès';
				$return['type'] = 'success';
				$return['ext']  = 'Avatar';
			} else {
				$return['msg']  = 'Echec de l\'upload !';
				$return['type'] = 'warning';
				$return['ext']  = 'Erreur inconnu';
			}
		} else {
			$return['msg']  = 'Aucun upload d\'image en cours...';
			$return['type'] = 'error';
			$return['ext']  = 'Aucune image';
		}
		return $return;
	}
	#########################################
	# Selectionne l'avatar ou le supprime
	#########################################
	public function avatarSubmit ($data)
	{
		if ($data['select'] == 'select') {
			if ($data['avatar']) {
				$ext = new SplFileInfo($data['avatar']);
				$extensions = array('png', 'gif', 'jpg', 'jpeg');
				if (in_array($ext->getExtension(), $extensions)) {
					$sql = New BDD();
					$sql->table('TABLE_USERS');
					$sql->where(array('name'=>'hash_key','value'=>$_SESSION['USER']['HASH_KEY']));
					$sql->sqlData(array('avatar'=> $data['avatar']));
					$sql->update();

					$return['msg']  = 'Avatar changer avec succès';
					$return['type'] = 'success';
					$return['ext']  = 'Avatar';
				} else {
					$return['msg']  = 'mavaise extention de l\'avatar';
					$return['type'] = 'warning';
					$return['ext']  = 'Avatar';
				}
			} else {
				$return['msg']  = 'Aucune avatar';
				$return['type'] = 'warning';
				$return['ext']  = 'Avatar';
			}
		} else if ($data['select'] == 'delete') {
			$sql = New BDD();
			$sql->table('TABLE_USERS');
			$sql->where(array('name'=>'hash_key','value'=>$_SESSION['USER']['HASH_KEY']));
			$sql->queryOne();
			$return->$sql->data;
			if (!empty($return)) {
				if ($return->avatar == $data['avatar']) {
					$sql = New BDD();
					$sql->table('TABLE_USERS');
					$sql->where(array('name'=>'hash_key','value'=>$_SESSION['USER']['HASH_KEY']));
					$sql->sqlData(array('avatar'=> ''));
					$sql->update();
				}
			}
			$link = DIR_UPLOADS;
			$link .= $data['avatar'];
			// @ = fix erreur Windows localhost
			@unlink($link);
			$return['msg']  = $link;
			$return['type'] = 'success';
			$return['ext']  = 'Avatar';
		}

		return $return;
	}
	#########################################
	# Change les liens social
	#########################################
	public function sendSubmitSocial ($data)
	{
		$update['facebook']   = empty($data['facebook'])   ? '' : Secure::isString($data['facebook']);
		$update['linkedin']   = empty($data['linkedin'])   ? '' : Secure::isString($data['linkedin']);
		$update['twitter']    = empty($data['twitter'])    ? '' : Secure::isString($data['twitter']);
		$update['googleplus'] = empty($data['googleplus']) ? '' : Secure::isString($data['googleplus']);
		$update['pinterest']  = empty($data['pinterest'])  ? '' : Secure::isString($data['pinterest']);

		if (!empty($data)) {
			$sql = New BDD();
			$sql->table('TABLE_USERS_SOCIAL');
			$sql->sqlData($update);
			$sql->update();

			$return['msg']  = 'Liens sociaux modifier avec succès';
			$return['type'] = 'success';
			$return['ext']  = 'Liens';
		} else {
			$return['msg']  = 'Erreur aucune données';
			$return['type'] = 'warning';
			$return['ext']  = 'Liens';
		}

		return $return;
	}
}