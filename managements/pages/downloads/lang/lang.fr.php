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
	# Fichier lang en français - Pages Téléchargements
	#####################################
	'SEND_NEWCAT_SUCCESS'  => 'Catégorie ajouter avec succès',
	'SEND_NEWCAT_ERROR'    => 'Erreur lors de l\'ajout de la Catégorie',
	'SEND_EDITCAT_SUCCESS' => 'Catégorie editer avec succès',
	'SEND_EDITCAT_ERROR'   => 'Erreur lors de l\'édition de la Catégorie',
	'DEL_CAT_SUCCESS'      => 'Suppression de la catégorie effectué avec succès',
	'DEL_CAT_ERROR'        => 'Erreur lors de la suppression de la catégorie',
	'ERROR_NO_DATA'        => 'Erreur de transfert de données',
));