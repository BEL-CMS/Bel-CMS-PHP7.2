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
	'NEW_BLOG_SUCCESS'      => 'Ajout de l\'article ajouter avec succès.',
	'DEL_BLOG_SUCCESS'      => 'Suppression du blog avec succès',
	'DEL_BLOG_ERROR'        => 'Erreur lors de la suppresion du blog',
	'EDIT_BLOG_SUCCESS'     => 'Edition du blog avec succès',
	'EDIT_BLOG_ERROR'       => 'Erreur durant l\'edition de l\'article',
	'NB_BLOG'               => 'Maximum d\'article à afficher',
	'NB_BLOG_ADMIN'         => 'Maximum d\'article à afficher (Admin)',
	'SEEN'                  => 'Vu',
	'POST_BY'               => 'Postée par'
));
