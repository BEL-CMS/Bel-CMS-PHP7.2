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
	# Fichier lang en français - Page Newsletter
	#####################################
	'SEND_TEMPLATE_SUCCESS' => 'Ajout du template newsletter avec succès',
	'SEND_TEMPLATE_ERROR'   => 'Erreur lors de l\'ajout du template newsletter',
	'DEL_TEMPLATE_SUCCESS'  => 'Effacement du template éffectué avec succès',
	'DEL_TEMPLATE_ERROR'    => 'Erreur lors de la suppression du templates',
));