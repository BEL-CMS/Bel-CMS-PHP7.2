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
?>
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Forum</h3>
	</div>
	<div class="card-body">
		<table class="DataTableBelCMS table table-vcenter table-condensed table-bordered">
			<thead>
				<tr>
					<th><?=ICON?></th>
					<th><?=NAME?></th>
					<th><?=CATEGORY?></th>
					<th class="td-actions"><?=OPTIONS?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th><?=ICON?></th>
					<th><?=NAME?></th>
					<th><?=CATEGORY?></th>
					<th class="td-actions"><?=OPTIONS?></th>
				</tr>
			</tfoot>
			<tbody>
				<?php
				foreach ($data as $k => $v):
					?>
					<tr>
						<td><i class="<?=$v->icon?>"></i></td>
						<td><?=$v->title?></td>
						<?php
						if (isset($v->id_forum->title)) {
							?>
							<td><?=$v->id_forum->title?></td>
							<?php
						} else {
							?>
							<td><?=UNKNOWN?></td>
							<?php
						}
						?>
						<td class="td-actions">
							<a href="/Forum/EditForum/<?=$v->id?>?management&page=true">
								<i class="fas fa-pen"> </i>
							</a> - 
							<a href="#" data-toggle="modal" data-target="#modal_<?=$v->id?>"><i class="fas fa-trash-alt"></i></a>
							<div class="modal fade" id="modal_<?=$v->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="exampleModalLabel"><?=$v->title?></h4>
										</div>
										<div class="modal-body">Confirmer la suppression du sous forum : <?=$v->title?></div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
											<button onclick="window.location.href='/Forum/delForum/<?=$v->id?>?management&page=true'" type="button" class="btn btn-primary">Supprimer</button>
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
		</table>
	</div>
</div>