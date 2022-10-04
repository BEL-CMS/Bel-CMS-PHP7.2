<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.1
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

function testWrite ($dir)
{
	if (is_writable(ROOT.$dir) === true) {
		return true;
	} else {
		return false;
	}
}

switch ($dir) {
	case 'comments':
		if (testWrite($dir) === true) {
			$create = ROOT.$dir;
		}
	break;

	case 'downloads':
		if (testWrite($dir) === true) {
			$create = ROOT.$dir;
		}
	break;

	case 'emoticones':
		if (testWrite($dir) === true) {
			$create = ROOT.$dir;
		}
	break;

	case 'forum':
		if (testWrite($dir) === true) {
			$create = ROOT.$dir;
		}
	break;

	case 'games':
		if (testWrite($dir) === true) {
			$create = ROOT.$dir;
		}
	break;

	case 'team':
		if (testWrite($dir) === true) {
			$create = ROOT.$dir;
		}
	break;

	case 'users':
		if (testWrite($dir) === true) {
			$create = ROOT.$dir;
		}	
	break;
}
