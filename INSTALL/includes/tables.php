<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.3.0
 * @link http://www.bel-cms.be
 * @link http://www.stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2016 Bel-CMS
 * @author Stive - mail@stive.eu
 */

$error      = true;
$class      = null;
$insert     = null;
$sql        = null;

switch ($table) {

	case 'ban':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`author` varchar(32) NOT NULL,
			`ip` text NOT NULL,
			`date` int(11) NOT NULL,
			`reason` text NOT NULL,
			PRIMARY KEY (`id`),
			UNIQUE KEY `author` (`author`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
	break;

	case 'comments':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`page` varchar(32) NOT NULL,
			`page_sub` varchar(32) NOT NULL,
			`page_id` int(11) NOT NULL,
			`comment` text NOT NULL,
			`hash_key` varchar(32) NOT NULL,
			`date_com` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
	break;

	case 'config':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(32) NOT NULL,
			`value` text NOT NULL,
			PRIMARY KEY (`id`),
			UNIQUE KEY `name` (`name`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
		$insert = "INSERT INTO `".$_SESSION['prefix'].$table."` (`id`, `name`, `value`) VALUES
			(NULL, 'CMS_WEBSITE_NAME', ''),
			(NULL, 'CMS_TPL_WEBSITE', ''),
			(NULL, 'CMS_WEBSITE_DESCRIPTION', ''),
			(NULL, 'CMS_REGISTER_CHARTER', 'En poursuivant votre navigation sur ce site, vous acceptez nos conditions générales d\'utilisation et notamment que des cookies soient utilisés afin de vous connecter automatiquement.'),
			(NULL, 'CMS_MAIL_WEBSITE', ''),
			(NULL, 'CMS_WEBSITE_KEYWORDS', ''),
			(NULL, 'CMS_WEBSITE_LANG', 'fr'),
			(NULL, 'CMS_TPL_FULL', 'readmore, user, forum, downloads, members, page, inbox'),
			(NULL, 'BELCMS_DEBUG', '0'),
			(NULL, 'CMS_JQUERY', 'on'),
			(NULL, 'CMS_JQUERY_UI', 'on'),
			(NULL, 'CMS_BOOTSTRAP', 'on'),
			(NULL, 'DATE_INSTALL', '".time()."'),
			(NULL, 'API_KEY', '".md5(uniqid(rand(), true))."');";
	break;

	case 'config_pages':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(50) NOT NULL,
			`active` tinyint(1) NOT NULL,
			`access_groups` text NOT NULL,
			`access_admin` text NOT NULL,
			`config` text,
			PRIMARY KEY (`id`),
			UNIQUE KEY `name` (`name`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
		$insert = "INSERT INTO `".$_SESSION['prefix'].$table."` (`id`, `name`, `active`, `access_groups`, `access_admin`, `config`) VALUES
			(NULL, 'blog', 1, '0', '1', 'MAX_BLOG=2|MAX_BLOG_ADMIN=25'),
			(NULL, 'members', 1, '0', '1', 'MAX_USER=10'),
			(NULL, 'team', 1, '0', '1', 'MAX_USER=10'),
			(NULL, 'shoutbox', 1, '0', '1', 'MAX_MSG=15'),
			(NULL, 'forum', 1, '0', '1', 'NB_MSG_FORUM=6'),
			(NULL, 'user', 1, '0', '1', 'MAX_USER=5|MAX_USER_ADMIN=20'),
			(NULL, 'page', 1, '0', '1', ''),
			(NULL, 'downloads', 1, '0', '1', ''),
			(NULL, 'inbox', 1, '0', '1', ''),
			(NULL, 'managements', 1, '1', '1', '');";
	break;

	case 'downloads':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `name` varchar(128) NOT NULL,
		  `description` text,
		  `idcat` int(11) NOT NULL,
		  `size` varchar(8) NOT NULL,
		  `uploader` varchar(32) NOT NULL,
		  `date` datetime DEFAULT CURRENT_TIMESTAMP,
		  `ext` text NOT NULL,
		  `view` int(11) NOT NULL,
		  `dls` int(11) NOT NULL,
		  `screen` text NOT NULL,
		  `download` text NOT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
	break;

	case 'downloads_cat':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
		  `id` int(10) NOT NULL AUTO_INCREMENT,
		  `name` varchar(128) NOT NULL,
		  `banner` text DEFAULT NULL,
		  `ico` text DEFAULT NULL,
		  `description` text NOT NULL,
		  `groups` text NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;

	case 'games':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(10) NOT NULL AUTO_INCREMENT,
			`name` varchar(128) NOT NULL,
			`banner` text,
			`ico` text,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
	break;

	case 'groups':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(10) NOT NULL AUTO_INCREMENT,
			`name` varchar(32) NOT NULL,
			`id_group` int(2) NOT NULL,
			PRIMARY KEY (`id`),
			UNIQUE KEY `name` (`name`),
			UNIQUE KEY `id_group` (`id_group`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
		$insert = "INSERT INTO `".$_SESSION['prefix'].$table."` (`id`, `name`, `id_group`) VALUES
			(NULL, 'ADMINISTRATORS', 1),
			(NULL, 'MEMBERS', 2);";
	break;

	case 'inbox':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(10) NOT NULL AUTO_INCREMENT,
			`username` varchar(32) NOT NULL,
			`usersend` varchar(32) NOT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
	break;

	case 'inbox_msg':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`id_msg` int(11) NOT NULL,
			`username` varchar(32) NOT NULL,
			`date_msg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`message` text NOT NULL,
			`status` tinyint(1) NOT NULL DEFAULT '0',
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
	break;

	case 'interaction':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`title` varchar(255) DEFAULT NULL,
			`author` varchar(32) DEFAULT NULL,
			`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`type` text NOT NULL,
			`text` text,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
	break;

	case 'mails_blacklist':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(255) NOT NULL,
			PRIMARY KEY (`id`),
			UNIQUE KEY `name` (`name`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
		$insert = "INSERT INTO `".$_SESSION['prefix'].$table."` (`id`, `name`) VALUES
			(NULL, 'yopmail'),
			(NULL, 'jetable'),
			(NULL, 'mail-temporaire'),
			(NULL, 'ephemail'),
			(NULL, 'trashmail'),
			(NULL, 'kasmail'),
			(NULL, 'spamgourmet'),
			(NULL, 'tempomail'),
			(NULL, 'mytempemail'),
			(NULL, 'saynotospams'),
			(NULL, 'tempemail'),
			(NULL, 'mailinator'),
			(NULL, 'mytrashmail'),
			(NULL, 'mailexpire'),
			(NULL, 'maileater'),
			(NULL, 'guerrillamail'),
			(NULL, '10minutemail'),
			(NULL, 'dontreg'),
			(NULL, 'filzmail'),
			(NULL, 'spamfree24'),
			(NULL, 'brefmail'),
			(NULL, '0-mail'),
			(NULL, 'link2mail'),
			(NULL, 'dodgeit'),
			(NULL, 'e4ward'),
			(NULL, 'gishpuppy'),
			(NULL, 'haltospam'),
			(NULL, 'mailNull'),
			(NULL, 'nobulk'),
			(NULL, 'nospamfor'),
			(NULL, 'PookMail'),
			(NULL, 'shortmail'),
			(NULL, 'sneakemail'),
			(NULL, 'spam'),
			(NULL, 'spambob'),
			(NULL, 'spambox'),
			(NULL, 'spamDay'),
			(NULL, 'spamh0le'),
			(NULL, 'spaml'),
			(NULL, 'tempInbox'),
			(NULL, 'temporaryinbox'),
			(NULL, 'willhackforfood'),
			(NULL, 'willSelfdestruct'),
			(NULL, 'wuzupmail'),
			(NULL, 'mailhazard'),
			(NULL, 'mail');";
	break;

	case 'maintenance':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(128) NOT NULL,
			`value` varchar(256) NOT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		$insert = "INSERT INTO `".$_SESSION['prefix'].$table."` (`id`, `name`, `value`) VALUES
			(1, 'status', 'open'),
			(2, 'title', 'Le site est temporairement inaccessible'),
			(3, 'description', 'Le site est temporairement inaccessible en raison d’activités de maintenance planifiées');";
	break;

	case 'newsletter':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(128) NOT NULL,
			`email` varchar(256) NOT NULL,
			`sendmail` int(11) NOT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;

	case 'newsletter_send':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`template` int(11) NOT NULL,
			`author` varchar(32) NOT NULL,
			`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;	

	case 'newsletter_tpl':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(128) NOT NULL,
			`template` varchar(128) NOT NULL,
			`author` varchar(32) NOT NULL,
			`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;

	case 'page':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(64) NOT NULL,
			`content` longtext NOT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;

	case 'page_blog':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`rewrite_name` varchar(128) NOT NULL,
			`name` varchar(128) NOT NULL,
			`date_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`author` varchar(32) DEFAULT NULL,
			`authoredit` varchar(32) DEFAULT NULL,
			`content` text NOT NULL,
			`additionalcontent` text,
			`tags` text DEFAULT NULL,
			`cat` varchar(16) DEFAULT NULL,
			`view` int(11) DEFAULT '0',
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		$insert = "INSERT INTO `".$_SESSION['prefix'].$table."` (`id`, `rewrite_name`, `name`, `date_create`, `author`, `authoredit`, `content`, `additionalcontent`, `tags`, `cat`, `view`) VALUES (NULL, 'Bienvenue_sur_votre_site_bel-cms', 'Bienvenue sur votre site bel-cms', '".date('Y-m-d H:i:s')."', NULL, NULL, 'Bienvenue sur votre site Bel-CMS, votre installation s\'est, à priori, bien déroulée, rendez-vous dans la partie administration pour commencer à utiliser votre site tout simplement en vous loguant avec le e-mail indiqué lors de l\'installation. En cas de problèmes, veuillez le signaler sur <a href=\"https://bel-cms.be\">https://bel-cms.be</a> dans le forum prévu à cet effet.', NULL, NULL, NULL, '0')";
	break;

	case 'page_content':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`number` tinyint(4) NOT NULL,
			`name` varchar(128) NOT NULL,
			`pagenumber` int(11) NOT NULL,
			`content` longtext,
			`publish` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;

	case 'page_forum':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`title` varchar(64) NOT NULL,
			`subtitle` varchar(128) NOT NULL,
			`access_groups` text NOT NULL,
			`access_admin` text NOT NULL,
			`activate` tinyint(1) DEFAULT '1',
			`orderby` int(11) NOT NULL DEFAULT '0',
			PRIMARY KEY (`id`),
			UNIQUE KEY `title` (`title`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;

	case 'page_forum_post':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`id_threads` int(11) NOT NULL,
			`title` varchar(128) NOT NULL,
			`author` varchar(32) NOT NULL,
			`options` text NOT NULL,
			`date_post` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`attachment` varchar(128) NOT NULL,
			`content` text NOT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;

	case 'page_forum_posts':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`id_post` int(11) NOT NULL,
			`author` varchar(32) NOT NULL,
			`options` text NOT NULL,
			`date_post` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`attachment` varchar(255) NOT NULL,
			`content` text NOT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;

	case 'page_forum_threads':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`id_forum` int(11) NOT NULL,
			`title` varchar(128) NOT NULL,
			`subtitle` varchar(256) NOT NULL,
			`orderby` int(11) DEFAULT NULL,
			`options` text NOT NULL,
			`icon` text NOT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;

	case 'page_shoutbox':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`hash_key` varchar(32) NOT NULL,
			`avatar` varchar(256) NOT NULL,
			`date_msg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`msg` text,
			PRIMARY KEY (`id`),
			FULLTEXT KEY `msg` (`msg`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;

	case 'page_survey':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`idvote` int(11) NOT NULL,
			`number` varchar(256) NOT NULL,
			`content` text NOT NULL,
			`vote` int(11) DEFAULT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;

	case 'page_survey_author':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`idvote` int(11) NOT NULL,
			`author` varchar(32) NOT NULL,
			`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;

	case 'page_survey_quest':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` text NOT NULL,
			`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;

	case 'page_users':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`username` varchar(32) NOT NULL,
			`password` char(255) NOT NULL,
			`email` varchar(128) NOT NULL,
			`avatar` varchar(255) DEFAULT NULL,
			`hash_key` char(32) NOT NULL,
			`date_registration` datetime NOT NULL,
			`last_visit` datetime NOT NULL,
			`groups` text NOT NULL,
			`main_groups` text NOT NULL,
			`valid` int(1) NOT NULL,
			`ip` varchar(255) NOT NULL,
			`token` varchar(50) DEFAULT NULL,
			PRIMARY KEY (`id`),
			UNIQUE KEY `mail` (`email`),
			UNIQUE KEY `name` (`username`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;

	case 'page_users_profils':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`hash_key` varchar(32) NOT NULL,
			`gender` varchar(11) DEFAULT NULL,
			`public_mail` varchar(128) DEFAULT NULL,
			`websites` text DEFAULT NULL,
			`list_ip` text DEFAULT NULL,
			`list_avatar` text DEFAULT NULL,
			`config` text DEFAULT NULL,
			`info_text` text DEFAULT NULL,
			`birthday` date DEFAULT NULL,
			`country` varchar(30) DEFAULT NULL,
			`hight_avatar` varchar(255) DEFAULT NULL,
			`friends` longtext DEFAULT NULL,
			PRIMARY KEY (`id`),
			UNIQUE KEY `hash_key` (`hash_key`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;

	case 'page_users_social':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`hash_key` varchar(32) DEFAULT NULL,
			`facebook` varchar(255) DEFAULT NULL,
			`linkedin` varchar(128) DEFAULT NULL,
			`twitter` varchar(35) DEFAULT NULL,
			`googleplus` varchar(128) DEFAULT NULL,
			`pinterest` varchar(35) DEFAULT NULL,
			PRIMARY KEY (`id`),
			UNIQUE KEY `hash_key` (`hash_key`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;

	case 'team':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`game` int(11) NOT NULL,
			`name` varchar(64) NOT NULL,
			`description` text,
			`img` text NOT NULL,
			`orderby` varchar(3) NOT NULL DEFAULT '1',
			PRIMARY KEY (`id`),
			UNIQUE KEY `name` (`name`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;

	case 'team_users':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`teamid` varchar(16) NOT NULL,
			`author` varchar(32) NOT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	break;

	case 'visitors':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`visitor_user` varchar(255) DEFAULT NULL,
			`visitor_ip` varchar(32) DEFAULT NULL,
			`visitor_browser` varchar(255) DEFAULT NULL,
			`visitor_hour` smallint(2) NOT NULL DEFAULT '0',
			`visitor_minute` smallint(2) NOT NULL DEFAULT '0',
			`visitor_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`visitor_day` varchar(2) NOT NULL,
			`visitor_month` varchar(2) NOT NULL,
			`visitor_year` smallint(4) NOT NULL,
			`visitor_refferer` varchar(255) DEFAULT NULL,
			`visitor_page` varchar(255) DEFAULT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
	break;

	case 'widgets':
		$drop = 'DROP TABLE IF EXISTS `'.$_SESSION['prefix'].$table.'`';
		$sql  = "CREATE TABLE IF NOT EXISTS `".$_SESSION['prefix'].$table."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(64) NOT NULL,
			`title` varchar(64) NOT NULL,
			`groups_access` varchar(255) NOT NULL,
			`groups_admin` varchar(255) NOT NULL,
			`active` tinyint(1) DEFAULT NULL,
			`pos` varchar(6) NOT NULL,
			`orderby` int(11) NOT NULL,
			`pages` text NOT NULL,
			`config` text NOT NULL,
			PRIMARY KEY (`id`),
			UNIQUE KEY `name` (`name`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		$insert = "INSERT INTO `".$_SESSION['prefix'].$table."` (`id`, `name`, `title`, `groups_access`, `groups_admin`, `active`, `pos`, `orderby`, `pages`, `config`) VALUES
			(1, 'users', 'Utilisateurs', '0', '1', 1, 'left', 1, '', 'CSS=1|JS=1'),
			(2, 'shoutbox', 'T\'chats', '0', '1', 1, 'top', 1, 'blog|forum', 'MAX_MSG=20|JS=1|CSS=1'),
			(3, 'connected', 'Connecté', '0', '1', 1, 'left', 2, 'blog', 'CSS=1|JS=1'),
			(4, 'lastconnected', 'Dernier connecté', '0', '1', 3, 'top', 1, 'blog', 'CSS=1|JS=1'),
			(5, 'donates', 'Paypal', '0', '1', 1, 'right', 1, '', 'CSS=1|JS=1'),
			(6, 'newsletter', 'Newsletter', '0', '1', 1, 'right', 2, '', 'CSS=1|JS=1');";

	break;
}

$pdo_options = array();
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES utf8';

if (!is_null($sql)) {
	try {
		$cnx = new PDO('mysql:host='.$_SESSION['host'].';port='.$_SESSION['port'].';dbname='.$_SESSION['dbname'], $_SESSION['username'], $_SESSION['password'], $pdo_options);;
		$cnx->exec($drop);
	} catch(PDOException $Exception) {
		$error = 'ERROR BDD INSERT DATA : '.$table.'<br>';
		$error .= '<pre>'.($Exception->getMessage()).'</pre>';
		echo $error;
		$error = false;
		$class = '<span class="glyphicon glyphicon-remove"></span>';
	}
	unset($cnx);
}

if ($error) {
	try {
		$cnx = new PDO('mysql:host='.$_SESSION['host'].';port='.$_SESSION['port'].';dbname='.$_SESSION['dbname'], $_SESSION['username'], $_SESSION['password'], $pdo_options);
		$cnx->exec($sql);
		$class = '<span class="glyphicon glyphicon-ok"></span>';
	} catch(PDOException $Exception) {
		$error = 'ERROR BDD INSERT DATA : '.$table.'<br>';
		$error .= '<pre>'.($Exception->getMessage()).'</pre>';
		echo $error;
		$error = false;
		$class = '<span class="glyphicon glyphicon-remove"></span>';
	}
	unset($cnx);
}

if ($error && !is_null($insert)) {
	try {
		$cnx = new PDO('mysql:host='.$_SESSION['host'].';port='.$_SESSION['port'].';dbname='.$_SESSION['dbname'], $_SESSION['username'], $_SESSION['password'], $pdo_options);
		$cnx->exec($insert);
		$class = '<span class="glyphicon glyphicon-ok"></span>';
	} catch(PDOException $Exception) {
		$error = 'ERROR BDD INSERT DATA : '.$table.'<br>';
		$error .= '<pre>'.($Exception->getMessage()).'</pre>';
		echo $error;
		$error = false;
		$class = '<span class="glyphicon glyphicon-remove"></span>';
	}
	unset($cnx);
}
