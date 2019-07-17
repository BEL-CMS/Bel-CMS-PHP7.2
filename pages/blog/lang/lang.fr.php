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
