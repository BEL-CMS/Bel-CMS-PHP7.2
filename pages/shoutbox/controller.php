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

class Shoutbox extends Pages
{
	var $models = array('ModelsShoutbox');

	public function index ()
	{
		$this->render('index');
	}

	public function send ()
	{
		$return = self::insertMsg();
		echo json_encode($return);
	}
	public function getLast ()
	{
		$id = (int) $_GET['id'];
		$return = null;
		$sql = New BDD();
		$sql->table('TABLE_SHOUTBOX');
		$sql->orderby(array(array('name' => 'id', 'type' => 'DESC')));
		$where = array('name' => 'id', 'value' => $id, 'op' => '>');
		$sql->where($where);
		$sql->queryAll();
		if (!empty($sql->data)) {
			$return = $sql->data;
		} else {
			$return = array();
		}
		return $return;
	}
	public function get()
	{
		$return = '';
			$get = self::getLast();
		$i = 1;
		foreach ($get as $k => $v):
			$i++;
			if ($i & 0) {
				$left_right =  'by_myself right';
			} else {
				$left_right =  'from_user left';
			}

			if (!empty($v->hash_key)) {
				$infosUser = Users::getInfosUser($v->hash_key);
				$username  = $infosUser[$v->hash_key]->username;
				$avatar    = empty($infosUser[$v->hash_key]->avatar) ? 'assets/images/default_avatar.jpg' : $infosUser[$v->hash_key]->avatar;
			} else {
				$username  = 'Inconnu';
				$avatar    = 'assets/images/default_avatar.jpg';
			}

			$msg = ' ' . $v->msg;
			$msg = preg_replace("#([\t\r\n ])(www|ftp)\.(([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)#i", '\1<a href="http://\2.\3" onclick="window.open(this.href); return false;">\2.\3</a>', $msg);
			$msg = preg_replace("#([\n ])([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $msg);
			$msg = preg_replace_callback('`((https?|ftp)://\S+)`', 'cesure_href',$msg);

			$return .= '<li class="'.$left_right.'" id="id_'.$v->id.'">
				<a data-toggle="tooltip" title="'.$username.'" href="Members/View/'.$username.'" class="avatar">
					<img src="'.$avatar.'">
				</a>
				<div class="message_wrap"> <span class="arrow"></span>
					<div class="info"> <a data-toggle="tooltip" title="'.$username.'" href="Members/View/'.$username.'" class="name">'.$username.'</a> <span class="time">'.$v->date_msg.'</span>
					</div>
					<div class="text">'.$msg.'</div>
				</div>
			</li>';
		endforeach;

		echo $return;
	}

	public function insertMsg()
	{
		if (strlen($_SESSION['USER']['HASH_KEY']) != 32) {
			$return['text'] = 'Erreur HashKey';
			$return['type'] = 'danger';
			return json_encode($return);
		} else {
			$data['hash_key'] = $_SESSION['USER']['HASH_KEY'];
		}

		if (!empty($_SESSION['USER']['HASH_KEY'])) {
			$infosUser = Users::getInfosUser($_SESSION['USER']['HASH_KEY']);
			$data['avatar'] = empty($infosUser[$_SESSION['USER']['HASH_KEY']]->avatar) ? 'assets/images/default_avatar.jpg' : $infosUser[$_SESSION['USER']['HASH_KEY']]->avatar;
		} else {
			$data['avatar']    = 'assets/images/default_avatar.jpg';
		}

		if (empty($_REQUEST['text'])) {
			$return['text'] = 'Erreur Message Vide';
			$return['type'] = 'danger';
			return json_encode($return);
		} else {
			$data['msg'] = Common::VarSecure($_REQUEST['text'], '<a><b><p><strong>');
		}

		$this->sql = New BDD();
		$this->sql->table('TABLE_SHOUTBOX');
		$this->sql->sqldata($data);
		$this->sql->insert();

		$return['text']	= 'Message envoyer avec succès';
		$return['type']	= 'success';

		return json_encode($return);
	}

	public function getMessageJson ($api_key)
	{
		if (defined('API_KEY')) {
			if (!empty($api_key) && $api_key == constant('API_KEY')) {
				echo json_encode(array('shoutbox' => $this->ModelsShoutbox->getMsgJson()));
			} else {
				$return['shoutbox'] = 'Erreur API Key';
				echo json_encode($return);
			}
		} else {
			$return['shoutbox'] = 'Erreur API Key';
			echo json_encode($return);
		}
	}

	public function sendMessageJson ($api_key)
	{
		if (defined('API_KEY')) {
			if (!empty($api_key) && $api_key == constant('API_KEY')) {
				echo json_encode($this->ModelsShoutbox->insertMsgJson($this->data['hash_key'], $this->data['text']));
			} else {
				$return['text'] = 'Erreur API Key';
				echo json_encode($return);
			}
		} else {
			$return['text'] = 'Erreur API Key';
			echo json_encode($return);
		}
	}

}
