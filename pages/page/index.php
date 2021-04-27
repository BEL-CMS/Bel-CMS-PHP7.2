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
<section id="bel_cms_page_index">
	<table class="table table-striped jambo_table bulk_action">
		<tr>
		<th>Nom</th>
		<th>Nombre de page(s)</th>
	</tr>
	<?php
	foreach ($data as $k => $v):
		?>
		<tr>
			<td><a href="page/subpage/<?=$v->id?>/<?=$v->name?>"><?=$v->name?></a></td>
			<td><?=$v->count?></td>
		</tr>
		<?php
	endforeach;
	?>
	</table>
	<table class="table table-striped jambo_table bulk_action">
		<tr>
		<th>Nom</th>
	</tr>
	<?php
	foreach ($sub as $k => $v):
		?>
		<tr>
			<td><a href="page/intern/<?=$v?>"><?=$v?></a></td>
		</tr>
		<?php
	endforeach;
	?>
	</table>
</section>