<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author Stive - stive@determe.be
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
