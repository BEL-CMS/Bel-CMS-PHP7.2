<div class="col-md-3">
	<div class="panel panel-white">
		<div class="panel-body">
			<button onclick="window.location.href='/Blog/add?management&page=true'" class="email-compose-button btn btn-info btn-block">Composer</button>

				<ul class="list-unstyled mailbox-nav">
					<li class="active"><a href="Blog?management&page=true"><i class="fas fa-home"></i>Accueil</a></li>
					<li><a href="/Blog/add?management&page=true"><i class="fa fa-user-plus"></i><?=ADD?></a></li>
					<li><a href="Blog/parameter?management&page=true"><i class="fas fa-cogs"></i>Configuration</a></li>
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
							<td><?=$v->id_forum->title?></td>
							<td class="td-actions">
								<a href="Forum/EditForum/<?=$v->id?>?management" class="btn btn-small btn-success">
									<i class="btn-icon-only icon-edit"> </i>
								</a>
								<a href="#modal_<?=$v->id?>" role="button" data-toggle="modal" class="btn btn-danger btn-small">
									<i class="btn-icon-only icon-remove"> </i>
								</a>
								<div id="modal_<?=$v->id?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h3 id="myModalLabel">Suppression du forum</h3>
									</div>
									<div class="modal-body">
										<p>Etes vous certain de d'effacer le forum : <?=$v->title?></p>
									</div>
									<div class="modal-footer">
										<button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
										<a href="Forum/DelForum/<?=$v->id?>?management" class="btn btn-primary">Supprimer</a>
									</div>
								</div>
							</td>
						</tr>
						<?php
					endforeach;
					?>
				</tbody>
			</table>
			<button class="btn" onclick="window.location.href='Forum/AddForum?management&page=true'"><i class="icon-plus"></i> <?=ADD?></button>
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