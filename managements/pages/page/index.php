<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
?>
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Télécharments</h3>
	</div>
	<div class="card-body">
		<?php
		foreach ($data as $key => $value):
		?>
		<tr>
			<a href="/page/getpage/<?=$value->id?>?management&pages" class="btn btn-app">
				<span class="badge bg-red"><?=$value->count?></span>
				<i class="fa far fa-file-alt"></i> <?=$value->name?>
			</a>
		<?php
		endforeach;
		?>
	</div>
</div>