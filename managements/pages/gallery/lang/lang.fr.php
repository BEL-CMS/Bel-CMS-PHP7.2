<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.1
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
	# Fichier lang en français - Pages gallery
	#####################################
	'EDIT_DL_PARAM_SUCCESS' => 'Edition des parametres effecté avec succès',
	'EDIT_DL_PARAM_ERROR'   => 'Error lors de la sauvegarde des parametre',
	'ERROR_NO_DATA'         => 'Erreur de transfert de données'
));