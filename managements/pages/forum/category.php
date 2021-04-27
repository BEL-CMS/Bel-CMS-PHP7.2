<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="block full">
		    <div class="block-title">
		        <h2><strong>Manu Page</strong> Forum</h2>
		    </div>
			<div class="table-responsive">
				<table id="datatableblog" class="table table-striped jambo_table bulk_action">
					<thead>
						<tr>
							<th><?=TITLE?></th>
							<th><?=SUBTITLE?></th>
							<th><?=ACTIVATE?></th>
							<th class="td-actions"><?=OPTIONS?></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th><?=TITLE?></th>
							<th><?=SUBTITLE?></th>
							<th><?=ACTIVATE?></th>
							<th class="td-actions"><?=OPTIONS?></th>
						</tr>
					</tfoot>
					<tbody>
						<?php
						foreach ($data as $k => $v):
							$v->activate = $v->activate == 1 ? ACTIVE : DISABLE;
							?>
							<tr>
								<td><?=$v->title?></td>
								<td><?=$v->subtitle?></td>
								<td><?=$v->activate?></td>
								<td class="td-actions">
									<a href="/Forum/EditCat/<?=$v->id?>?management&page=true" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
									<a href="#" data-toggle="modal" data-target="#modal_<?=$v->id?>" class="btn btn-danger"><i class="fa fa-times"></i></a>
									<div class="modal fade" id="modal_<?=$v->id?>" data-toggle="tooltip" title="Delete" tabindex="-1" role="dialog" aria-labelledby="modal">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="modal"><?=$v->title?></h4>
												</div>
												<div class="modal-body">Confirmer la suppression de la categorie : <?=$v->title?></div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													<button onclick="window.location.href='/Forum/delCategory/<?=$v->id?>?management&page=true'" type="button" class="btn btn-primary">Supprimer</button>
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
</div>