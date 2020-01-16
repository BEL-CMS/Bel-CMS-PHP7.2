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

Common::constant(array(
	#####################################
	# Fichier lang en français - Pages Blog
	#####################################
	'SEND_PAGE_SUCCESS'       => 'Page ajouté avec succès',
	'SEND_PAGE_ERROR'         => 'Erreur lors de l\'ajout de la page',
	'ERROR_NO_DATA'           => 'Erreur de transfert de données',
	'EDIT_PAGE_SUCCESS'       => 'Edition de la page effectué avec succès',
	'EDIT_PAGE_ERROR'         => 'Erreur lors de l\'edition de la page',
));