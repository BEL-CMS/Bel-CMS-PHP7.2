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
<div class="col-md-3">
	<div class="panel panel-white">
		<div class="panel-body">
			<button onclick="window.location.href='/Code/add?management&page=true'" class="email-compose-button btn btn-info btn-block">Composer</button>

				<ul class="list-unstyled mailbox-nav">
					<li class="active"><a href="Code?management&page=true"><i class="fas fa-home"></i>Accueil</a></li>
					<li><a href="/Code/add?management&page=true"><i class="fa fa-user-plus"></i><?=ADD?></a></li>
					<li><a href="/Code/parameter?management&page=true"><i class="fas fa-cogs"></i>Configuration</a></li>
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
						<th>#</th>
						<th><?=NAME?></th>
						<th><?=CATEGORY?></th>
						<th><?=AUTHOR?></th>
						<th class="td-actions"><?=OPTIONS?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>#</th>
						<th><?=NAME?></th>
						<th><?=CATEGORY?></th>
						<th><?=AUTHOR?></th>
						<th class="td-actions"><?=OPTIONS?></th>
					</tr>
				</tfoot>
				<tbody>
					<?php
					foreach ($data as $key => $value):
					?>
					<tr>
						<td><?=$value->id?></td>
						<td><?=$value->name?></td>
						<td><?=$value->cat?></td>
						<td><?=Users::hashkeyToUsernameAvatar($value->author)?></td>
							<td>
								<a href="Code/edit/<?=$value->id?>?management&page=true>"><i class="fas fa-pen"></i></a> - 
								<a href="#" data-toggle="modal" data-target="#modal_<?=$value->id?>"><i class="fas fa-trash-alt"></i></a>
								<div class="modal fade" id="modal_<?=$value->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="exampleModalLabel"><?=$value->name?></h4>
											</div>
											<div class="modal-body">Confirmer la suppression du code : <?=$value->name?></div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												<button onclick="window.location.href='/Code/del/<?=$value->id?>?management&page=true'" type="button" class="btn btn-primary">Supprimer</button>
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