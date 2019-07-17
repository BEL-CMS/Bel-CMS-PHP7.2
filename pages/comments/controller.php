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
