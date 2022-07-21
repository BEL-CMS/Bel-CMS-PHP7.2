<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2014-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
?>
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Activities</h3>
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
		  		<i class="fas fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="card-body">
		<table class="DataTableBelCMS table table-bordered table-hover">
			<thead>
				<th>Auteur</th>
				<th>Type</th>
				<th>Date</th>
				<th>Avec</th>
			</thead>
			<tbody>
		<?php
		foreach ($data as $k => $v):
			?>
				<tr>
					<td><span style="color: <?=Users::colorUsername($v->author)?>"><?=Users::hashkeyToUsernameAvatar($v->author);?></span></td>
					<td><?=$v->text;?></td>
					<td><?=$v->date;?></td>
					<td>avec <?=$v->type;?></td>
				</tr>
			<?php
		endforeach;
		?>
			</tbody>
			<tfoot>
				<th>Auteur</th>
				<th>Type</th>
				<th>Date</th>
				<th>Avec</th>
			</tfoot>
		</table>
	</div>
</div>