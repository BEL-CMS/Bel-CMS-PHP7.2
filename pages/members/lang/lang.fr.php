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
	# Fichier lang en français - Users
	#####################################
	'MEMBERS'            => 'Membres',
	'LAST_FORUM'         => 'Dernier Topic',
	'UNKNOW_GROUP'       => 'Groupe inconnu',
	'UNKNOW_MEMBER'      => 'Cet utilisateur n\'exsite pas',
	'ADD_FRIEND_SUCCESS' => 'utilisateur ajouter en ami avec succès',
	'ADD_FRIEND_ERROR'   => 'Impossible d\'ajouter l\'ami',
	'ALL'                => 'Tous',
	'LAST_VISIT'         => 'Dernière visite',
	'FRIEND'             => 'Ami',
	'FRIENDS'            => 'Amis',

)); 