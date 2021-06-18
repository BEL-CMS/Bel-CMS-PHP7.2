<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="block full">
		    <div class="block-title">
		        <h2><strong>Liste des blog</strong></h2>
		    </div>
			<div class="table-responsive">
				<table  class="DataTableBelCMS table table-vcenter table-condensed table-bordered">
				<thead>
					<tr>
						<th># ID</th>
						<th># ID POST</th>
						<th>Auteur</th>
						<th>Date du message</th>
						<th>Like / Report</th>
						<th>Options</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th># ID</th>
						<th># ID POST</th>
						<th>Auteur</th>
						<th>Date du message</th>
						<th>Like / Report</th>
						<th>Options</th>
					</tr>
				</tfoot>
				<tbody>
					<?php
					foreach ($data as $key => $v) {
						?>
						<tr>
							<td><?=$v->id;?></td>
							<td><?=$v->id_post;?></td>
							<td style="color:<?=Users::colorUsername($v->author)?>"><?=Users::hashkeyToUsernameAvatar($v->author)?></td>
							<td><?=$v->date_post;?></td>
							<td><?=$v->options['like']?> / <?=$v->options['report']?></td>
							<td class="td-actions">
								<a href="/Forum/EditMessage/<?=$v->id?>?management&page=true" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
								<a href="#" data-toggle="modal" data-target="#modal_<?=$v->id?>" class="btn btn-danger"><i class="fa fa-times"></i></a>
								<div class="modal fade" id="modal_<?=$v->id?>" data-toggle="tooltip" title="Delete" tabindex="-1" role="dialog" aria-labelledby="modal">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="modal"><?=$v->id?></h4>
											</div>
											<div class="modal-body">Confirmer la suppression du message id : <?=$v->id;?><br>
												<?=$v->content?>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												<button onclick="window.location.href='/Forum/delMessage/<?=$v->id?>?management&page=true'" type="button" class="btn btn-primary">Supprimer</button>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			   </table>  
			</div>
		</div>
	</div>
</div>