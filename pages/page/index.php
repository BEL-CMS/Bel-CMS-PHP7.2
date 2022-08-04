<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
if (!empty($data)):
?>
<div id="belcms_page" class="card">
	<div class="card-header">Page(s)</div>
	<div class="card-body">
		<table class="table table-striped">
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
	</div>
</div>
<hr>
<?php
endif;
if (!empty($sub)):
?>
<div class="card">
	<div class="card-header">Page(s) : Interne</div>
	<div class="card-body">
		<table class="table table-striped">
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
	</div>
</div>
<?php
endif;
if (empty($data) and empty($sub)):
Notification::warning('Aucune page de disponible', 'Pages');
endif;