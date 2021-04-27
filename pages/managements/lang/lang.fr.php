<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.3
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
	'MANAGEMENTS'                   => 'Administration',
	'MANAGEMENT_TITLE_NAME'         => 'Paramètres Général',
	'SAVE_BDD_SUCCESS'              => 'Sauvegarde éffectué avec succès',
	'ADMIN_DATE_INSTALL'            => 'Date d\'installation',
	'ADMIN_CMS_WEBSITE_NAME'        => 'Nom de votre site',
	'ADMIN_CMS_WEBSITE_LANG'        => 'Langue de votre site',
	'ADMIN_CMS_WEBSITE_KEYWORDS'    => 'Mot clés',
	'ADMIN_CMS_WEBSITE_DESCRIPTION' => 'Description du site',
	'ADMIN_CMS_TPL_WEBSITE'         => 'Template',
	'ADMIN_CMS_TPL_FULL'            => 'Page en "full"',
	'ADMIN_CMS_REGISTER_CHARTER'    => 'Charte d\'enregistrement',
	'ADMIN_CMS_MAIL_WEBSITE'        => 'e-mail administrateur',
	'ADMIN_CMS_JQUERY_UI'           => 'Activer : jQuery UI (1.12.1)',
	'ADMIN_CMS_JQUERY'              => 'Activer : jQuery (3.3.1)',
	'ADMIN_CMS_BOOTSTRAP'           => 'Activer : Bootstrap (4.1.3)',
	'ADMIN_BELCMS_DEBUG'            => 'Activer les erreur',
	'ADMIN_API_KEY'                 => 'API clé externe',
	'ALLOW'					 		=> "Accorder",
	'REFUSE'				 		=> 'Refusé',

	'COMPLEMENT'                    => 'Complèments', 
));