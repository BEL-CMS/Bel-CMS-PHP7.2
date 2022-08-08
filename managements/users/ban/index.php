<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.1
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2022 Bel-CMS
 * @author Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
?>
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Gestion des bannissements</h3>
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
		  		<i class="fas fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="card-body">
		<table class="DataTableBelCMS table table-vcenter table-condensed table-bordered">
			<thead>
				<tr>
					<th># ID</th>
					<th>Author</th>
					<th>IP</th>
					<th>Date</th>
					<th>Options</th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($ban as $k => $v):
				?>
				<tr>
					<td><?=$v->id?></td>
					<td><?=Users::hashkeyToUsernameAvatar($v->author)?></td>
					<td><?=$v->ip?></td>
					<td><?=$v->date?></td>
					<td>
						<a href="#" data-toggle="modal" data-target="#modal_<?=$v->id?>" class="btn btn btn-danger btn-sm mb-1">Supprimer</a>
						<div class="modal fade" id="modal_<?=$v->id?>" tabindex="-1" role="dialog">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									</div>
									<div class="modal-body">Confirmer la suppression du ban de "<?=Users::hashkeyToUsernameAvatar($v->author)?></div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
										<button onclick="window.location.href='/ban/del/<?=$v->author?>?management&users'" type="button" class="btn btn-primary">Supprimer</button>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<?php
			endforeach;
			?>
			</tbody>
			<tfoot>
				<tr>
					<th># ID</th>
					<th>Author</th>
					<th>IP</th>
					<th>Date</th>
					<th>Options</th>
				</tr>
			</tfoot>
			<tbody>
			</tbody>
		</table>
	</div>
</div>