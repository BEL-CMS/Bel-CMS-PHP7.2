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

final class Comment extends Dispatcher
{
	private function getMessage ()
	{
		$sql = New BDD();
		$sql->table('TABLE_COMMENTS');
		$where[] = array('name' => 'page', 'value' => $this->links[0]);
		$where[] = array('name' => 'page_sub', 'value' => $this->links[1]);
		if (isset($this->links[3]) and !empty($this->links[3])) {
			$where[] = array('name' => 'page_id', 'value' => $this->links[3]);
		}
		$sql->where($where);
		$sql->queryAll();

		foreach ($sql->data as $k => $v) {
			$sql->data[$k]->user = self::getDataUser($v->hash_key);
		}

		return $sql->data;
	}

	private function getDataUser ($hash_key = null)
	{
		if ($hash_key AND strlen($hash_key) == 32) {
			$sql = New BDD();
			$sql->table('TABLE_USERS');
			$sql->where(array('name' => 'hash_key', 'value' => $hash_key));
			$sql->fields(array('username', 'avatar'));
			$sql->queryOne();
			$data = $sql->data;
			if ($sql->rowCount == 1) {
				if (empty($data->username)) {
					$data->username = 'Non répertorié';
				}
				if (empty($data->avatar)) {
					$data->avatar = '/assets/images/default_avatar.jpg';
				}
				$return = $data;
			} else {
				$return['username'] = 'Non répertorié';
				$return['avatar'] = '/assets/images/default_avatar.jpg';
				$return = (object) $return;
			}
		} else {
			$return['username'] = 'Non répertorié';
			$return['avatar'] = '/assets/images/default_avatar.jpg';
			$return = (object) $return;
		}
		return $return;
	}

	public function html ()
	{
		$link  = null;
		$html  = '<section id="belcms_comments">';
		$html .= '<header>';
		$html .= '<span>Poster vos commentaires.';
		$html .= '</header>'; 

		$message = self::getMessage();

		foreach ($message as $k => $v) {
			$html .= '<div class="belcms_comments_content">';
			$html .= '<div class="belcms_comments_avatar">';
			$html .= '<img src="'.$v->user->avatar.'" alt="avatar">';
			$html .= '</div>';
			$html .= '<div class="belcms_comments_infos">';
			$html .= '<span id="belcms_comments_username">'.$v->user->username.'</span>';
			$html .= '<span id="belcms_comments_reply"><a href="#" data-toggle="tooltip" title="Reply"><i class="fab fa-replyd"></i></a></span>';
			$html .= '<span id="belcms_comments_date">'.$v->date_com.'</span>';
			$html .= '</div>';
			$html .= '<div class="belcms_comments_com">'.$v->comment.'</div>';
			$html .= '</div>';
		}
		if (isset($_SESSION['USER']['HASH_KEY'])) {
			$links = $this->links[0].'/'.$this->links[1].'/';
			if (isset($this->links[3]) and !empty($this->links[3])) {
				$links .= $this->links[3];
			}
		$html .= '<form action="Comments/Send" method="post" enctype="multipart/form-data"><input name="url" type="hidden" value="'.$links.'"><textarea class="bel_cms_textarea_simple" name="text"></textarea><button type="submit" style="margin: 5px;" class="btn btn-primary">Envoyer</button></form>';
		}

		echo $html;
	}
	public static function countComments($page, $page_id)
	{
		$sql = New BDD;
		$sql->table('TABLE_COMMENTS');
		$where[] = array(
					'name'  => 'page_id',
					'value' => (int) $page_id
				);
		$where[] = array(
					'name'  => 'page',
					'value' => $page
				);
		$sql->where($where);
		$sql->count();
		return $sql->data;
	}
}
