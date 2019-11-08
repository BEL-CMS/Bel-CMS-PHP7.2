<div class="x_panel">
	<div class="x_title">
		<h2>Menu Page Forum</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<a href="/Forum?management&page=true" class="btn btn-app">
			<i class="fa fas fa-home"></i> Accueil
		</a>
		<a href="Forum/parameter?management&page=true" class="btn btn-app">
			<i class="fa fas fa-cogs"></i> Configuration
		</a>
		<a href="/Forum/category?management&page=true" class="btn btn-app">
			<i class="fa far fa-plus-square"></i> <?=CATEGORY?>
		</a>
		<a href="/Forum/AddForum?management&page=true" class="btn btn-app">
			<i class="fa fas fa-plus"></i> <?=ADD?>
		</a>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-white">
		<div class="panel-body">
			<!-- fin des boutton action -->
			<table id="datatableblog" class="table table-striped jambo_table bulk_action">
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
			<button class="btn" onclick="window.location.href='/Forum/AddForum?management&page=true'"><i class="icon-plus"></i> <?=ADD?></button>
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