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

Common::constant(array(
	#####################################
	# Fichier lang en français - Pages Shoutbox
	#####################################
	'EDIT_SHOUTBOX_SUCCESS'    => 'Message éditer avec succès',
	'EDIT_SHOUTBOX_ERROR'      => 'Erreur durant l\'édition',
	'ERROR_NO_DATA'            => 'Erreur de transfert de données',
	'DEL_SHOUTBOX_SUCCESS'     => 'Message supprimer avec succès',
	'DEL_SHOUTBOX_ERROR'       => 'Erreur lors de la suppression du message',
	'DEL_ALL_SHOUTBOX_SUCCESS' => 'Suppression de tout les message avec succès',
	'DEL_ALL_SHOUTBOX_ERROR'   => 'Erreur lors de la suppression de tout les messages',
));
