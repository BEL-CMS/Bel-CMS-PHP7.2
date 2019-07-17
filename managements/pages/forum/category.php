<div class="col-md-3">
	<div class="panel panel-white">
		<div class="panel-body">
				<ul class="list-unstyled mailbox-nav">
					<li><a href="/Forum?management&page=true"><i class="fas fa-home"></i>Accueil</a></li>
					<li class="active"><a href="/Forum/addcategory?management&page=true"><i class="far fa-plus-square"></i><?=CATEGORY?></a></li>
					<li><a href="/Forum/parameter?management&page=true"><i class="fas fa-cogs"></i>Configuration</a></li>
					<hr>
					<li><a href="#"><i class="fa fa-send"></i>Nombre de Forum <span class="badge badge-default pull-right"></span></a></li>
				</ul>
		</div>
	</div>
</div>
<div class="col-md-9">
	<div class="panel panel-white">
		<div class="panel-body">
			<!-- fin des boutton action -->
			<table id="datatableblog" class="display table table-data-width">
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
								<a href="/Forum/EditCat/<?=$v->id?>?management&page=true" class="btn btn-small btn-success">
									<i class="fas fa-pen"> </i>
								</a>
								<a href="#" data-toggle="modal" data-target="#modal_<?=$v->id?>" class="btn btn-danger btn-small"><i class="fas fa-trash-alt"></i></a>
								<div class="modal fade" id="modal_<?=$v->id?>" tabindex="-1" role="dialog" aria-labelledby="modal">
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
			<button class="btn" onclick="window.location.href='/Forum/addcategory?management&page=true'"><i class="icon-plus"></i> <?=ADD?></button>
		</div>
	</div>
</div>
<script src="/assets/plugins/jquery-3.3.1/jquery-3.3.1.min.js"></script>
<script src="/managements/assets/datatables/js/jquery.datatables.min.js"></script>
<script>
	(function($){
		$('#datatableblog').dataTable( {
			"language": {
				"sProcessing":     "Traitement en cours...",
				"sSearch":         "Rechercher&nbsp;:",
				"sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
				"sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
				"sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
				"sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
				"sInfoPostFix":    "",
				"sLoadingRecords": "Chargement en cours...",
				"sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
				"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
				"oPaginate": {
					"sFirst":      "Premier",
					"sPrevious":   "Pr&eacute;c&eacute;dent",
					"sNext":       "Suivant",
					"sLast":       "Dernier"
				},
				"oAria": {
					"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
					"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
				},
				"select": {
						"rows": {
							_: "%d lignes séléctionnées",
							0: "Aucune ligne séléctionnée",
							1: "1 ligne séléctionnée"
						} 
				}
			}
		} );
	})(jQuery);
</script>