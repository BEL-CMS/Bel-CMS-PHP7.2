<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.2
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit('<!doctype html><html><head><meta charset="utf-8"><title>BEL-CMS : Error 403 Forbidden</title><style>h1{margin: 20px auto;text-align:center;color: red;}p{text-align:center;font-weight:bold;</style></head><body><h1>HTTP Error 403 : Forbidden</h1><p>You don\'t permission to access / on this server.</p></body></html>');
}

Common::constant(array(
	#####################################
	# Fichier lang en français - Pages Blog
	#####################################
	'EDIT_BLOG_SUCCESS'       => 'Blog éditer avec succès',
	'EDIT_BLOG_ERROR'         => 'Erreur d\'edition',
	'ERROR_NO_DATA'           => 'Erreur de transfert de données',
	'BLOG'                    => 'Blog',
	'COMPLEMENT'              => 'Complément',
	'NB_BLOG'                 => 'Nombre de blog',
	'ERROR_NO_NUM'            => 'Erreur le texte rentrer n\'est pas du numerique',
	'EDIT_BLOG_PARAM_SUCCESS' => 'les paramètres du blog sont sauvegarder avec succès',
	'EDIT_BLOG_PARAM_ERROR'   => 'Erreur durant la sauvegarde des paramètres du blog',
	'SEND_BLOG_SUCCESS'       => 'La page été ajouté avec succès à votre blog',
	'SEND_BLOG_ERROR'         => 'La page n\'a pas pu etre ajouté : erreur BDD',
	'DEL_BLOG_SUCCESS'        => 'La page du blog à été supprimé avec succès',
	'DEL_BLOG_ERROR'          => 'Erreur durant la suppression du blog',
	'ADD_BLOG_EMPTY'          => 'Le nom ne peux-être vide',
	"ADD_BLOG_EMPTY_CONTENT"  => 'Le contenue ne peux-être vide',
));