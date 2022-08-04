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
	# Fichier lang en français - Pages Téléchargements
	#####################################
	'SEND_NEWCAT_SUCCESS'   => 'Catégorie ajouter avec succès',
	'SEND_NEWCAT_ERROR'     => 'Erreur lors de l\'ajout de la Catégorie',
	'SEND_EDITCAT_SUCCESS'  => 'Catégorie editer avec succès',
	'SEND_EDITCAT_ERROR'    => 'Erreur lors de l\'édition de la Catégorie',
	'DEL_CAT_SUCCESS'       => 'Suppression de la catégorie effectué avec succès',
	'EDIT_DL_PARAM_SUCCESS' => 'Edition des parametres effecté avec succès',
	'EDIT_DL_PARAM_ERROR'   => 'Error lors de la sauvegarde des parametre',
	'DEL_CAT_ERROR'         => 'Erreur lors de la suppression de la catégorie',
	'DEL_FILE_SUCCESS'      => 'Fichier effacer avec succès',
	'DEL_FILE_ERROR'        => 'Erreur lors de la suppression du fichier',
	'ADD_FILE_SUCCESS'      => 'Ajout du fichier avec succès',
	'ERROR_NO_DATA'         => 'Erreur de transfert de données',
));