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
	# Fichier lang en français - Pages Blog
	#####################################
	'CATEGORY'          => 'Catégrie',
	'TAGS'              => 'Tags',
	'CODE'              => 'Code',
	'DESCRIPTION'       => 'Déscription',
	'SEND_CODE_SUCCESS' => 'Code ajouté avec succès',
	'SEND_CODE_ERROR'   => 'Erreur durant la sauvegarde du code',
	'ERROR_NO_DATA'     => 'Pas de données transmis',
	'COURT_DESC'        => 'Courte description max(64car)'
));