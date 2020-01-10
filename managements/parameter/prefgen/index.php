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
?>
<div class="x_panel">
	<div class="x_title">
		<h2>Menu Page Parametres</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<a href="/Forum?management&page=true" class="btn btn-app">
			<i class="fa fas fa-home"></i> Accueil
		</a>
		<a href="Forum/parameter?management&page=true" class="btn btn-app">
			<i class="fa fas fa-cogs"></i> Configuration
		</a>
		<a href="/Forum/category?management&page=true" class="btn btn-app">
			<i class="fa far fa-plus-square"></i> <?=CATEGORY?>
		</a>
		<a href="/Forum/AddForum?management&page=true" class="btn btn-app">
			<i class="fa fas fa-plus"></i> <?=ADD?>
		</a>
	</div>
</div>