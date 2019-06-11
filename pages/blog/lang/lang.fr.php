<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
 * @link http://www.bel-cms.be
 * @link http://www.stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2016 Bel-CMS
 * @author Stive - mail@stive.eu
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

Common::constant(array(
	#####################################
	# Fichier lang en français - Blog
	#####################################
	'NO_POST'               => 'No Posts Found',
	'TAGS'                  => 'Tags',
	'READ_MORE'             => 'Lire la suite',
	'NAME_OF_THE_UNKNOW'    => 'Nom ou ID de la page inconnu',
	#####################################
	# Fichier lang en français - Admin
	#####################################
	'NEW_BLOG_ERROR'        => 'Une erreur est survenue durant l\'enregistrement en BDD.',
	'NEW_BLOG_SUCCESS'      => 'Ajout du blog ajouter avec succès.',
	'DEL_BLOG_SUCCESS'      => 'Suppression du blog avec succès',
	'DEL_BLOG_ERROR'        => 'Erreur lors de la suppresion du blog',
	'EDIT_BLOG_SUCCESS'     => 'Edition du blog avec succès',
	'EDIT_BLOG_ERROR'       => 'Erreur durant l\'edition du blog',
	'NB_BLOG'               => 'Maximum de blog à afficher',
	'NB_BLOG_ADMIN'         => 'Maximum de blog à afficher (Admin)',
	'SEEN'                  => 'Vu',
	'POST_BY'               => 'Postée par'
));
