<?php
/**
* Bel-CMS [Content management system]
* @version 1.0.0
* @link https://bel-cms.be
* @link https://determe.be
* @license http://opensource.org/licenses/GPL-3.0 copyleft
* @copyright 2014 Bel-CMS
* @author Stive - stive@determe.be
*/
$BDD = 'server';
$databases["server"] = array(
#####################################
# Réglages MySQL - SERVEUR
#####################################
'DB_DRIVER'   => 'mysql',
'DB_NAME'     => '26-04-2021',
'DB_USER'     => 'root',
'DB_PASSWORD' => 'root',
'DB_HOST'     => 'localhost',
'DB_PREFIX'   => 'belcms_',
'DB_PORT'     => '3306'
);
Common::constant($databases[$BDD]); unset($databases, $BDD);
