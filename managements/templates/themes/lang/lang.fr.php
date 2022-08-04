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

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

Common::constant(array(
	#####################################
	# Fichier lang en français - Pages thèmes
	#####################################
	'NAME_TPL'       => 'Nom du thème',
	'CREATOR'        => 'Créateur',
	'DESCRIPTION'    => 'Description',
	'VERSION'        => 'Version',
	'DATE'           => 'Date',
	'PAGE_FULL_WIDE' => 'Page sans widgets à gauche et à droite',
));