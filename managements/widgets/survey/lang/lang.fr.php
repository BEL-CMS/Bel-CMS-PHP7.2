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
	# Fichier lang en français - Pages Shoutbox
	#####################################
	'ADD_SONDAGE_SUCCESS'         => 'Ajout du sondage avec succès',
	'JS'                          => 'JavaScript',
	'CSS'                         => 'Cascading Style Sheets',
	'EDIT_SURVEY_PARAM_SUCCESS'   => 'les paramètres du widgets shoutbox sont sauvegarder avec succès',
	'EDIT_SURVEY_PARAM_ERROR'     => 'Erreur durant la sauvegarde des paramètres du widgets : shoutbox',
	'ERROR_NO_DATA'               => 'Erreur de transfert de données',
));
