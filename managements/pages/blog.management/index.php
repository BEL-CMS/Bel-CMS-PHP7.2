<div class="col-md-3">
	<div class="panel panel-white">
		<div class="panel-body">
			<button class="email-compose-button btn btn-info btn-block" data-toggle="modal" data-target="#compose">Composer</button>

				<ul class="list-unstyled mailbox-nav">
					<li class="active"><a href="inbox.html"><i class="fas fa-home"></i>Accueil</a></li>
					<li><a href="#"><i class="fas fa-cogs"></i>Configuration</a></li>
					<hr>
					<li><a href="#"><i class="fa fa-send"></i>Nombre de Blog <span class="badge badge-default pull-right">63</span></a></li>
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
						<th>Nom</th>
						<th>Date de création</th>
						<th>Auteur</th>
						<th>Options</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th># ID</th>
						<th>Nom</th>
						<th>Date de création</th>
						<th>Auteur</th>
						<th>Options</th>
					</tr>
				</tfoot>
				<tbody>
					<?php
					foreach ($data as $k => $v) {
						?>
						<tr>
							<td><?=$v->id?></td>
							<td><?=$v->name?></td>
							<td><?=$v->date_create?></td>
							<td><?=$v->author?></td>
							<td>
								<a href="blog/edit/<?=$v->id?>?management&page=true>"><i class="fas fa-pencil-alt"></i></a> | 
								<a href="blog/del/<?=$v->id?>?management&page=true"><i class="fas fa-times"></i></a>
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