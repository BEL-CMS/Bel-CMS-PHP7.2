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
	'EDIT_BLOG_SUCCESS'       => 'Blog éditer avec succès',
	'EDIT_BLOG_ERROR'         => 'Erreur d\'edition',
	'ERROR_NO_DATA'           => 'Erreur de transfert de données',
	'BLOG'                    => 'Blog',
	'COMPLEMENT'              => 'Complèmennt',
	'NB_BLOG'                 => 'Nombre de blog',
	'ERROR_NO_NUM'            => 'Erreur le texte rentrer n\'est pas du numerique',
	'EDIT_BLOG_PARAM_SUCCESS' => 'les paramètres du blog sont sauvegarder avec succès',
	'EDIT_BLOG_PARAM_ERROR'   => 'Erreur durant la sauvegarde des paramètres du blog',
));