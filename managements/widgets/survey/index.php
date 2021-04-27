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
?>
<div class="x_panel">
	<div class="x_title">
		<h2>Menu Widgets Sondage</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<a href="survey?management&widgets=true" class="btn btn-app">
			<i class="fa fas fa-home"></i> Accueil
		</a>
		<a href="survey/parameter?management&widgets=true" class="btn btn-app">
			<i class="fa fas fa-cogs"></i> Configuration
		</a>
		<a href="survey/add?management&widgets=true" class="btn btn-app">
			<i class="fa fas fa-plus"></i> <?=ADD?>
		</a>
		<a class="btn btn-app">
			<span class="badge bg-red"> <?=$count?></span>
			<i class="fa fa-bullhorn"></i> Message
		</a>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-white">
		<div class="panel-body">
			<table id="datatableblog" class="table table-striped jambo_table bulk_action">
				<thead>
					<tr>
						<th>Titre</th>
						<th>Date</th>
						<th>Options</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Titre</th>
						<th>Date</th>
						<th>Options</th>
					</tr>
				</tfoot>
				<tbody>
					<?php
					foreach ($data as $k => $v):
						?>
						<tr>
							<td><?=$v->name?></td>
							<td><?=$v->date?></td>
							<td>
								<a href="survey/edit/<?=$v->id?>?management&widgets=true>"><i class="fas fa-pen"></i></a> - 
								<a href="#" data-toggle="modal" data-target="#modal_<?=$v->id?>"><i class="fas fa-trash-alt"></i></a>
								<div class="modal fade" id="modal_<?=$v->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="exampleModalLabel">ID : <?=$v->id?></h4>
											</div>
											<div class="modal-body">Confirmer la suppression du sondage :<br><?=$v->name?></div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												<button onclick="window.location.href='/survey/delete/<?=$v->id?>?management&widgets=true'" type="button" class="btn btn-primary">Supprimer</button>
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