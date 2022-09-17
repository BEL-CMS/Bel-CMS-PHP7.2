<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.2
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit('<!doctype html><html><head><meta charset="utf-8"><title>BEL-CMS : Error 403 Forbidden</title><style>h1{margin: 20px auto;text-align:center;color: red;}p{text-align:center;font-weight:bold;</style></head><body><h1>HTTP Error 403 : Forbidden</h1><p>You don\'t permission to access / on this server.</p></body></html>');
}

class ModelsComments
{
	public function insertComment ($data = false)
	{
		if ($data !== false) {
			if (strlen($_SESSION['USER']['HASH_KEY']) != 32) {
				$return['text'] = 'Erreur Login';
				$return['type'] = 'error';
				return $return;
			} else {
				$data['hash_key'] = $_SESSION['USER']['HASH_KEY'];
				unset($data['user']);
			}

			if (empty($data['text'])) {
				$return['text'] = COMMENT_EMPTY;
				$return['type'] = 'error';
				return $return;
			} else {
				$data['comment'] = Common::VarSecure($data['text'], '<a><b><p><strong>');
				unset($data['text']);
			}

			if (empty($data['url'])) {
				$return['text'] = URL_EMPTY;
				$return['type'] = 'error';
				return $return;
			} else {
				$data['url'] = Common::VarSecure($data['url'], '');
				$data['url'] = explode('/', $data['url']);
				$data['page'] = $data['url'][0];
				$data['page_sub'] = $data['url'][1];
				$data['page_id'] = (int) $data['url'][2];
				unset($data['url']);
			}

			$sql = New BDD();
			$sql->table('TABLE_COMMENTS');
			$sql->sqldata($data);
			$sql->insert();

			if ($sql->rowCount == 1) {
				$return['text']	= COMMENT_SEND_TRUE;
				$return['type']	= 'success';
			} else {
				$return['text']	= COMMENT_SEND_FALSE;
				$return['type']	= 'danger';
			}

		} else {
			$return = false;
		}
		return $return;
	}
}
