<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2022 Bel-CMS
 * @author Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

Common::constant(array(
	#####################################
	# Fichier lang en français - Pages Groupes
	#####################################
	'GROUP_SEND_SUCCESS'  => 'Groupe ajouté avec succès.',
	'GROUP_ERROR_SUCCESS' => 'Erreur lors de la création du groupe.',
	'GROUP_NAME_RESERVED' => 'Ce nom est déjà réserve.',
	'DEL_GROUP_SUCCESS'   => 'Groupe éffacé avec succès.',
	'DEL_GROUP_ERROR'     => 'Impossible d\'effacer le groupe, problème inconnu.',
	'EDIT_GROUP_SUCCESS'  => 'Edition du groupe avec succès',
	'EDIT_GROUP_ERROR'    => 'Erreur de l\'Edition',
	'GROUP_NAME_EMPTY'    => 'Le nom de peux-être vide',
));
