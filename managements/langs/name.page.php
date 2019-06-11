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
	# Fichier lang en français - Pages
	#####################################
	'BLOG'      => 'Blog',
	'COMMENTS'  => 'Commentaires',
	'DOWNLOADS' => 'Téléchargements',
	'FORUM'     => 'Forum',
	'SHOUTBOX'  => 'T\'chat',
	'TEAM'      => 'Team',
	'USER'      => 'Utilisateurs'
));