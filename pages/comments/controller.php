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
