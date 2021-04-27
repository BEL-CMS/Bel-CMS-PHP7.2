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
		<h2>Menu Page</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<a href="/page?management&page=true" class="btn btn-app">
			<i class="fa fas fa-home"></i> Accueil
		</a>
		<a href="page/parameter?management&page=true" class="btn btn-app">
			<i class="fa fas fa-cogs"></i> Configuration
		</a>
		<a href="/page/add?management&page=true" class="btn btn-app">
			<i class="fa fas fa-plus"></i> <?=ADD?>
		</a>
	</div>
</div>

<div class="col-md-12">
	<div class="x_content">
		<?php
		foreach ($data as $key => $value):
		?>
			<a href="/page/getpage/<?=$value->id?>?management&page=true" class="btn btn-app">
				<span class="badge bg-red"><?=$value->count?></span>
				<i class="fa far fa-file-alt"></i> <?=$value->name?>
			</a>
		<?php
		endforeach;
		?>
	</div>
</div>