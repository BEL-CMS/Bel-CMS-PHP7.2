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
	# Fichier lang en français - Pages
	#####################################
	'HOME'                  => 'Accueil',
	'BLOG'                  => 'Blog',
	'COMMENTS'              => 'Commentaires',
	'CALENDAR'              => 'Calendrier',
	'COLOR'                 => 'Couleur',
	'COLORS'                => 'Couleurs',
	'DOWNLOADS'             => 'Téléchargements',
	'FORUM'                 => 'Forum',
	'SHOUTBOX'              => 'T\'chat',
	'USER'                  => 'Utilisateurs',
	'TEAM'                  => 'Équipes',
	'PARAMETERS'            => 'Paramètres',
	'PAGE'                  => 'Page',
	'PAGES'                 => 'Pages',
	'MAINTENANCE'           => 'Maintenance',
	'REGISTRATION'          => 'Gestions des membres',
	'THEMES'                => 'Gestions des Thèmes',
	'TEMPLATES'             => 'Thèmes',
	'NEWSLETTER'            => 'Newsletter',
	'SURVEY'                => 'Sondage',
	'MONITORING'            => 'Monitoring',
	'GROUPS'                => 'Gestion des groupes',
	'CONNECTED'             => 'Connecté',
	'LASTCONNECTED'         => 'Dernier connecté',
	'DONATES'               => 'Paypal',
	'NEWSLETTER'            => 'Newsletter',
	'GALLERY'               => 'Galerie',
	'ACTIVITY'              => 'Activité',
	'DOWNLOADS_IS_PROGRESS' => 'Chargement de la page en cours...',
	'BACK_TO_WEBSITE'       => 'Retour au site',
	'WIDGETS'               => 'Widgets',
	'GAMING'                => 'Jeu',
	'GAMINGS'               => 'Jeux',
	#####################################
	# Fichier lang en français
	#####################################
	'SEND_NEWCAT_SUCCESS'   => 'Catégorie ajouter avec succès',
	'SEND_NEWCAT_ERROR'     => 'Erreur lors de l\'ajout de la Catégorie',
	'SEND_EDITCAT_SUCCESS'  => 'Catégorie editer avec succès',
	'SEND_EDITCAT_ERROR'    => 'Erreur lors de l\'édition de la Catégorie',
	'SAVE_BDD_SUCCESS'      => 'La sauvegarde a été effectuée avec succès.'
));