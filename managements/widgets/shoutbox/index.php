<div class="col-md-3">
	<div class="panel panel-white">
		<div class="panel-body">
			<button onclick="window.location.href='/Shoutbox/deleteall?management&widgets=true'" class="email-compose-button btn btn-danger btn-block">Supprimer tout</button>

				<ul class="list-unstyled mailbox-nav">
					<li class="active"><a href="Blog?management&widgets=true"><i class="fas fa-home"></i>Accueil</a></li>
					<li><a href="Blog/parameter?management&widgets=true"><i class="fas fa-cogs"></i>Configuration</a></li>
					<hr>
					<li><a href="#"><i class="fa fa-send"></i>Nombre de message <span class="badge badge-default pull-right"><?=$count?></span></a></li>
				</ul>
		</div>
	</div>
</div>
<div class="col-md-9">
	<div class="panel panel-white">
		<div class="panel-body">
		   <div class="table-responsive">
			<table id="datatableblog" class="display table table-data-width">
				<thead>
					<tr>
						<th># ID</th>
						<th>Auteur</th>
						<th>Date du message</th>
						<th>Message</th>
						<th>Options</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th># ID</th>
						<th>Auteur</th>
						<th>Date du message</th>
						<th>Message</th>
						<th>Options</th>
					</tr>
				</tfoot>
				<tbody>
					<?php
					foreach ($data as $k => $v):
						?>
						<tr>
							<td><?=$v->id?></td>
							<td><?=Users::hashkeyToUsernameAvatar($v->hash_key)?></td>
							<td><?=$v->date_msg?></td>
							<td><?=Common::truncate($v->msg)?></td>
							<td>
								<a href="Shoutbox/edit/<?=$v->id?>?management&widgets=true>"><i class="fas fa-pen"></i></a> - 
								<a href="#" data-toggle="modal" data-target="#modal_<?=$v->id?>"><i class="fas fa-trash-alt"></i></a>
								<div class="modal fade" id="modal_<?=$v->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="exampleModalLabel">ID : <?=$v->id?></h4>
											</div>
											<div class="modal-body">Confirmer la suppression du message :<br><?=$v->msg?></div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												<button onclick="window.location.href='/Shoutbox/delete/<?=$v->id?>?management&widgets=true'" type="button" class="btn btn-primary">Supprimer</button>
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