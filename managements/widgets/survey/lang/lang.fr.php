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
	'ADD_SONDAGE_SUCCESS'         => 'Ajout du sondage avec succès',
	'JS'                          => 'JavaScript',
	'CSS'                         => 'Cascading Style Sheets',
	'EDIT_SURVEY_PARAM_SUCCESS'   => 'les paramètres du widgets shoutbox sont sauvegarder avec succès',
	'EDIT_SURVEY_PARAM_ERROR'     => 'Erreur durant la sauvegarde des paramètres du widgets : shoutbox',
	'ERROR_NO_DATA'               => 'Erreur de transfert de données',
));
