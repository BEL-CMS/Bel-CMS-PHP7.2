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