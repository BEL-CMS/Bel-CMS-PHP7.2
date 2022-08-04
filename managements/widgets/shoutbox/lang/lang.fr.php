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
	# Fichier lang en français - Pages Shoutbox
	#####################################
	'EDIT_SHOUTBOX_SUCCESS'       => 'Message éditer avec succès',
	'EDIT_SHOUTBOX_ERROR'         => 'Erreur durant l\'édition',
	'EDIT_SHOUTBOX_PARAM_SUCCESS' => 'les paramètres du widgets shoutbox sont sauvegarder avec succès',
	'EDIT_SHOUTBOX_PARAM_ERROR'   => 'Erreur durant la sauvegarde des paramètres du widgets : shoutbox',
	'ERROR_NO_DATA'               => 'Erreur de transfert de données',
	'DEL_SHOUTBOX_SUCCESS'        => 'Message supprimer avec succès',
	'DEL_SHOUTBOX_ERROR'          => 'Erreur lors de la suppression du message',
	'DEL_ALL_SHOUTBOX_SUCCESS'    => 'Suppression de tout les message avec succès',
	'DEL_ALL_SHOUTBOX_ERROR'      => 'Erreur lors de la suppression de tout les messages',
	'JS'                          => 'Javascript',
	'CSS'                         => 'Cascading Style Sheets',
	'NB_MSG'                      => 'Nombre de message',
));
