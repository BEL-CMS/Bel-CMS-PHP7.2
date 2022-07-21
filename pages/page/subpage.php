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
if (empty($data)):
	Notification::warning('Aucune page dans la BDD');
else:
?>
<div id="belcms_subpage" class="card">
	<div class="card-header">Page(s)</div>
	<div class="card-body">
		<table class="table table-striped">
			<tr>
				<th>Nom</th>
				<th>Page publié</th>
			</tr>
	<?php
	foreach ($data as $k => $v):
		?>
			<tr>
				<td><a href="page/read/<?=$v->id?>/<?=$v->name?>"><?=$v->name?></a></td>
				<td><?=$v->publish?></td>
			</tr>
		<?php
	endforeach;
	?>
		</table>
	</div>
</div>
<?php
endif;