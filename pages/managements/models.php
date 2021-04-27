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

class ModelsManagements
{
	#########################################
	# Infos tables
	#########################################
	# TABLE_CONFIG
	# TABLE_USERS
	# TABLE_USERS_PROFILS
	# TABLE_USERS_SOCIAL
	# TABLE_MAINTENANCE
	#########################################
	#########################################
	# recupere la configuration
	#########################################
	public function getConfig ()
	{

		$sql = New BDD();
		$sql->table('TABLE_CONFIG');
		$sql->orderby(array(array('name' => 'name', 'type' => 'DESC')));
		$sql->queryAll();

		foreach ($sql->data as $key => $value) {
			$return[$value->name] = $value->value;
		}
		
		return $return;	
	}
	#########################################
	# Recupere les utilisateurs
	#########################################
	public function getAllUsers ($id = null)
	{
		$sql = New BDD;
		$sql->table('TABLE_USERS');
		if ($id != null && is_numeric($id)) {
			$sql->where(array('name' => 'id', 'value' => $id));
		}
		$sql->queryAll();
		$return = $sql->data;

		return $return;
	}
	#########################################
	# Maintennance
	#########################################
	public function getMaintenance ()
	{
		$return = array();

		$sql = New BDD;
		$sql->table('TABLE_MAINTENANCE');
		$sql->queryAll();

		if ($sql->data) {
			foreach ($sql->data  as $k => $v) {
				$return[$v->name] = $v->value;
			}
		}

		return $return;
	}
	#########################################
	# Logout
	#########################################
	public static function sendLogout ()
	{
		if (isset($_SESSION['LOGIN_MANAGEMENT'])) {
			unset($_SESSION['LOGIN_MANAGEMENT']);
		}
	}
	#########################################
	# enregistre les config
	#########################################
	public function sendRG ($data = null)
	{
		foreach ($data as $k => $v) {
			$sql = New BDD();
			$sql->table('TABLE_CONFIG');
			$sql->where(array('name'=>'name','value'=>$k));
			$sql->sqlData(array('value' => $v));
			$sql->update();
			unset($sql);
		}

		$save = array(
			'type' => 'success',
			'text' => SAVE_BDD_SUCCESS
		);

		return $save;
	}
	#########################################
	# enregistre les config de maintennance
	#########################################
	public function sendRGMtn ($data = null)
	{
		if (isset($data["close"]) && ($data["close"] == 'open')) {
			$data["status"] = 'open';
		} else {
			$data["status"] = 'close';
		}

		$data["title"] = Common::VarSecure($data["title"], '');
		$data["description"] = Common::VarSecure($data['description'], 'html');

		foreach ($data as $k => $v) {
			$sql = New BDD();
			$sql->table('TABLE_MAINTENANCE');
			$sql->where(array('name'=>'name','value'=>$k));
			$sql->sqlData(array('value' => $data[$k]));
			$sql->update();
			unset($sql);
		}

		$save = array(
			'type' => 'success',
			'text' => SAVE_BDD_SUCCESS
		);

		return $save;
	}
	#########################################
	# recupere user par hash_key
	#########################################
	public function getUsers ($id = null)
	{
		$sql = New BDD;
		$sql->table('TABLE_USERS');
		if ($id != null && is_numeric($id)) {
			$sql->where(array('name' => 'hash_key', 'value' => $id));
		}
		$sql->queryOne();
		$return = $sql->data;

		return $return;
	}
	#########################################
	# recupere user profil par hash_key
	#########################################
	public function getUsersProfils ($id = null)
	{
		$sql = New BDD;
		$sql->table('TABLE_USERS_PROFILS');
		if ($id != null && is_numeric($id)) {
			$sql->where(array('name' => 'hash_key', 'value' => $id));
		}
		$sql->queryOne();
		$return = $sql->data;

		return $return;
	}
	#########################################
	# recupere user social par hash_key
	#########################################
	public function getUsersSocial ($id = null)
	{
		$sql = New BDD;
		$sql->table('TABLE_USERS_SOCIAL');
		if ($id != null && is_numeric($id)) {
			$sql->where(array('name' => 'hash_key', 'value' => $id));
		}
		$sql->queryOne();
		$return = $sql->data;

		return $return;
	}
	#########################################
	# enregsitre email
	#########################################
	public function sendPrivate ($data)
	{
		$sql = New BDD;
		$sql->table('TABLE_USERS');
		$sql->where(array('name' => 'hash_key', 'value' => $_SESSION['USER']['HASH_KEY']));
		$insert['email'] = Secure::isMail($data['email']);
		$sql->sqlData($insert);
		$sql->update();
		$return = array('type' => 'success', 'text' => 'le e-mail privé à été changé', 'title' => 'Paramètre privé');
		return $return;
	}
	#########################################
	# enregsitre groupe principale
	#########################################
	public function sendMainGroup ($data = null)
	{
		$update['main_groups'] = (int) $data;
		$sql = New BDD;
		$sql->table('TABLE_USERS');
		$sql->where(array('name' => 'hash_key', 'value' => $_SESSION['USER']['HASH_KEY']));
		$sql->sqlData($update);
		$sql->update();
		$return = array('type' => 'success', 'text' => 'le groupe principal à été changer', 'title' => 'Groupe primaire');
		return $return;
	}
	#########################################
	# enregsitre groupe secondaire
	#########################################
	public function sendSecondGroup ($data = null)
	{
		$update['groups'] = null;
		if (!empty($data)) {
			foreach ($data['second'] as $key => $value) {
				$update['groups'] .= $value.'|';
			}
		}
		$update['groups'] .= 2; // membres obligatoire

		$sql = New BDD;
		$sql->table('TABLE_USERS');
		$sql->where(array('name' => 'hash_key', 'value' => $_SESSION['USER']['HASH_KEY']));
		$sql->sqlData($update);
		$sql->update();
		$return = array('type' => 'success', 'text' => 'les groupes secondaire ont été changer', 'title' => 'Groupe seconaire');
		return $return;
	}
	#########################################
	# enregsitre social
	#########################################
	public function sendSocial ($data = null)
	{
		if ($data != null) {
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
				$return['text']     = 'Vos informations ont été sauvegardées avec succès';
				$return['type']     = 'success';
				$return['rowcount'] = $resultsCount;
			} else {
				$return['text']  = 'Aucune informations a été sauvegardées';
				$return['type']  = 'danger';
				$return['rowcount'] = $resultsCount;
			}
			return $return;
		}
	}
	#########################################
	# enregsitre infos public
	#########################################
	public function sendInfoPublic ($data)
	{
		if ($data && is_array($data)) {
			$update = New BDD();
			$update->table('TABLE_USERS_PROFILS');
			$update->sqlData($data);
			$update->where(array(
				'name'  => 'hash_key',
				'value' => $_SESSION['USER']['HASH_KEY']
			));
			$update->update();
			$returnSql = $update->data;
			$resultsCount = $returnSql;

			if ($resultsCount != null) {
				$return['text']     = 'Vos informations ont été sauvegardées avec succès';
				$return['type']     = 'success';
				$return['rowcount'] = $resultsCount;
			} else {
				$return['text']  = 'Aucune informations a été sauvegardées';
				$return['type']  = 'danger';
				$return['rowcount'] = $resultsCount;
			}
			return $return;
		}
	}

	public function getPages ()
	{
		$return = array();

		$sql = New BDD;
		$sql->table('TABLE_PAGES_CONFIG');
		$sql->queryAll();

		foreach ($sql->data as $k => $v) {
			$return[$v->name] = $v;
		}

		unset($return['managements']);

		return $return;
	}
	#########################################
	# PAGE !
	#########################################
	public function blogconfig ()
	{
		$data['groups'] = BelCMSConfig::getGroups();
		$data['config'] = BelCMSConfig::GetConfigPage("blog");
		return $data;
	}
	#########################################
	# PAGE BLOG
	#########################################
	public function blogindex ()
	{
		$data['data'] = self::getAllBlog();
		$data['count'] = self::getNbBlog();
		return $data;
	}
	public function getNbBlog ()
	{
		$return = 0;

		$sql = New BDD();
		$sql->table('TABLE_PAGES_BLOG');
		$sql->count();

		if (!empty($sql->data)) {
			$return = $sql->data;
		}

		return $return;
	}
	public function getAllBlog ()
	{
		$return = array();

		$sql = New BDD;
		$sql->table('TABLE_PAGES_BLOG');
		$sql->queryAll();

		if ($sql->data) {
			$return = $sql->data;
		}

		return $return;
	}
	public function blogadd ()
	{
		return array();
	}
	#########################################
	# PAGE !
	#########################################
}