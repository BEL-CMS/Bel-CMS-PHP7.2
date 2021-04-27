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
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="block full">
		    <div class="block-title">
		        <h2><strong>Menu page</strong> forum</h2>
		    </div>
			<div class="table-responsive">
			<!-- fin des boutton action -->
			<table  class="DataTableBelCMS table table-vcenter table-condensed table-bordered">
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
</div>