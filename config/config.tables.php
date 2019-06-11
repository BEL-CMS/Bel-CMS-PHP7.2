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

#########################################
# Correctif de l'absence de caractère
#########################################
if (defined('DB_PREFIX')) { $DB_PREFIX = DB_PREFIX; } else { $DB_PREFIX = ''; }
#########################################
# End Correctif
#########################################
Common::constant(array(
	#########################################
	# Tables
	#########################################
	'TABLE_COMMENTS'         => $DB_PREFIX.'comments',
	'TABLE_CONFIG'           => $DB_PREFIX.'config',
	'TABLE_PAGES_CONFIG'     => $DB_PREFIX.'config_pages',
	'TABLE_DOWNLOADS'        => $DB_PREFIX.'downloads',
	'TABLE_DOWNLOADS_CAT'    => $DB_PREFIX.'downloads_cat',
	'TABLE_GROUPS'           => $DB_PREFIX.'groups',
	'TABLE_INBOX'            => $DB_PREFIX.'inbox',
	'TABLE_INBOX_MSG'        => $DB_PREFIX.'inbox_msg',
	'TABLE_LINK_OUT'         => $DB_PREFIX.'links_click',
	'TABLE_MAIL_BLACKLIST'   => $DB_PREFIX.'mails_blacklist',
	'TABLE_PAGE'             => $DB_PREFIX.'page',
	'TABLE_PAGES_BLOG'       => $DB_PREFIX.'page_blog',
	'TABLE_PAGES_BLOG_CAT'   => $DB_PREFIX.'page_blog_cat',
	'TABLE_FORUM'            => $DB_PREFIX.'page_forum',
	'TABLE_FORUM_POST'       => $DB_PREFIX.'page_forum_post',
	'TABLE_FORUM_POSTS'      => $DB_PREFIX.'page_forum_posts',
	'TABLE_FORUM_THREADS'    => $DB_PREFIX.'page_forum_threads',
	'TABLE_SHOUTBOX'         => $DB_PREFIX.'page_shoutbox',
	'TABLE_USERS'            => $DB_PREFIX.'page_users',
	'TABLE_USERS_PROFILS'    => $DB_PREFIX.'page_users_profils',
	'TABLE_USERS_SOCIAL'     => $DB_PREFIX.'page_users_social',
	'TABLE_STATS'            => $DB_PREFIX.'stats',
	'TABLE_VISITORS'         => $DB_PREFIX.'visitors',
	'TABLE_WIDGETS'          => $DB_PREFIX.'widgets',
));
