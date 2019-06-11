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
###  TABLE_FORUM
###  TABLE_FORUM_POST
###  TABLE_FORUM_POSTS
###  TABLE_FORUM_THREADS
class ModelsForum
{
	#####################################
	# Récupère les noms des forums
	#####################################
	public function getForum ()
	{
		$return = array();

		$sql = new BDD;
		$sql->table('TABLE_FORUM');
		$where = array('name' => 'activate', 'value' => 1);
		$sql->where($where);
		$sql->fields(array('id', 'title', 'subtitle', 'groups'));
		$sql->orderBy(array('name' => 'orderby', 'value' => 'ASC'));
		$sql->queryAll();

		if ($sql->rowCount != 0) {
			foreach ($sql->data as $k => $v) {
				$return[$v->id] = $v;
				$return[$v->id]->threads = array();
				unset($return[$v->id]->id);
			}
		}

		return $return;
	}
	#####################################
	# Récupère tout les threads
	#####################################
	public function getThreads ()
	{
		$return = array();

		$sql = new BDD;
		$sql->table('TABLE_FORUM_THREADS');
		$sql->queryAll();

		if ($sql->rowCount != 0) {
			$return = $sql->data;
		}

		return $return;
	}
	#####################################
	# Count le nombre de post
	#####################################
	public function getCountPost ($post = null)
	{
		$return = 0;

		if ($post !== null) {
			$sql = new BDD;
			$sql->table('TABLE_FORUM_POST');
			$sql->where(array('name' => 'id_threads', 'value' => $post));
			$sql->count();
			if ($sql->rowCount != 0) {
				$return = $sql->data;
			}
		}
		return $return;
	}
	#####################################
	# forum post
	#####################################
	public function getPost ($post = null)
	{
		$return = (object) array();
		$sql = new BDD;
		$sql->table('TABLE_FORUM_POST');
		if ($post !== null) {
			$sql->where(array('name' => 'id_threads', 'value' => (int) $post));
		}
		$sql->orderby(array(array('name' => 'id', 'type' => 'DESC')));
		$sql->queryAll();
		$return = $sql->data;
		return $return;
	}
	#####################################
	# Last post
	#####################################
	public function getLastPost ($post = null, $threads = true)
	{
		$return = '';

		if ($post !== null) {
			$sql = new BDD;
			$sql->table('TABLE_FORUM_POST');
			$where = $threads === true ? 'id_threads' : 'id';
			$sql->orderby(array(array('name' => 'id', 'type' => 'DESC')));
			$sql->where(array('name' => $where, 'value' => $post));
			$sql->isObject(false);
			$sql->queryOne();
			$return = $sql->data;
		}
		return $return;
	}
	#####################################
	# Last posts
	#####################################
	public function getLastPosts ($post = null, $id_post = true)
	{
		$return = '';

		if ($post !== null) {
			$sql = new BDD;
			$sql->table('TABLE_FORUM_POSTS');
			$where = $id_post === true ? 'id_post' : 'id';
			$sql->orderby(array(array('name' => 'id', 'type' => 'DESC')));
			$sql->where(array('name' => $where, 'value' => (int) $post));
			$sql->isObject(false);
			$sql->queryOne();
			$return = $sql->data;
		}
		return $return;
	}
	#####################################
	# ADD post
	#####################################
	public function AddPost ($id, $data) {
		if (Users::isLogged() === false) {
			$return['title'] = 'Erreur login';
			$return['msg']   = 'Veuillez vous logué';
			$return['type']  = 'error';
			return $return;
		}
		if (Users::ifUserExist($_SESSION['USER']['HASH_KEY']) === false) {
			$return['title'] = 'HASH_KEY';
			$return['msg']   = 'L\'utilisateur n\'existe pas !!!';
			$return['type']  = 'error';
			return $return;
		}
		if (is_array($data) and !empty($data)) {
			# les données à inserer
			$insert['id']         = NULL;
			$insert['id_threads'] = (int) $id;
			$insert['title']      = strip_tags(fixUrl($data['title']));
			$insert['author']     = $_SESSION['USER']['HASH_KEY'];
			$insert['options']    = 'lock=0|like=0|report=0|pin=0|view=0|post=0';
			$insert['date_post']  = date("Y-m-d H:i:s");
			$insert['attachment'] = '';
			$insert['content']    = Common::VarSecure(trim($data['content']));
			# insert en BDD
			$sql = New BDD();
			$sql->table('TABLE_FORUM_POST');
			$sql->sqlData($insert);
			$sql->insert();
			# verifie si c'est bien inserer
			if ($sql->rowCount == 1) {
				$return['title'] = 'Enregistrement';
				$return['msg']   = 'Enregistrement du nouveau post en cours...';
				$return['type']  = 'success';
			} else {
				$return['title'] = 'BDD';
				$return['msg']   = ERROR_BDD;
				$return['type']  = 'error';
			}
		} else {
			$return['title'] = 'Erreur';
			$return['msg']   = 'Erreur de données';
			$return['type']  = 'warning';
		}
		return $return;
	}
}