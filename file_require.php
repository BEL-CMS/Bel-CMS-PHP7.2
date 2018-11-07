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

final class RequireFiles
{
	var $files = array();

	function __construct ()
	{
		$this->files = array(
			function_exists('password_hash') ? '' : DIR_CORE.'core.password.php',
			DIR_CORE.'core.session.php',
			DIR_CORE.'core.dispatcher.php',
			DIR_CORE.'core.common.php',
			DIR_CORE.'core.host.php',
			DIR_CONFIG.'config.inc.php',
			DIR_CONFIG.'config.tables.php',
			DIR_CORE.'core.spdo.php',
			DIR_CORE.'core.config.php',
			DIR_CORE.'core.notification.php',
			DIR_LANG.'langs.fr.php',
			DIR_CORE.'core.access.php',
			DIR_CORE.'core.secure.php',
			DIR_CORE.'core.comment.php',
			DIR_CORE.'core.user.php',
			DIR_CORE.'core.visitors.php',
			DIR_CORE.'core.config.page.php',
			DIR_CORE.'core.assembly.pages.php',
			DIR_CORE.'core.assembly.widgets.php',
			DIR_CORE.'core.widgets.php',
			DIR_CORE.'core.template.php',
			DIR_CORE.'core.belcms.php'
		);
		self::getFiles();
	}
	private function getFiles ()
	{
		if (function_exists('password_hash')) {
			unset($this->files[0]);
		}
		foreach ($this->files as $file) {
			if (is_file($file)) {
				require_once $file;
			} else {
				throw new Exception ('file '.$file.' not found.');
				break;
			}
		}
	}
}