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

class Comments extends Pages
{
	var $models = array('ModelsComments');

	public function send ()
	{
		if (isset($_SESSION['USER']['HASH_KEY']) and strlen($_SESSION['USER']['HASH_KEY']) == 32) {
			if (empty($_POST['text'])) {
				$this->error('Commentaires', COMMENT_EMPTY, 'error');
				return;
			}
			if (empty($_POST['url'])) {
				$this->error('Commentaires', URL_EMPTY, 'error');
				return;
			}
			$insert = $this->ModelsComments->insertComment($this->data);
			if ($insert === false) {
				$this->error('Commentaires', $insert['text'], $insert['type']);
			} else {
				$this->error('Commentaires', $insert['text'], $insert['type']);
			}
		}
		$this->redirect(true, 3);
	}
}
