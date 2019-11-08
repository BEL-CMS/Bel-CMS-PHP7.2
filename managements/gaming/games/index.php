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
<div class="x_panel">
	<div class="x_title">
		<h2>Menu Page Team</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<a href="/games?management&gaming=true" class="btn btn-app">
			<i class="fa fas fa-home"></i> Accueil
		</a>
		<a href="/games/add?management&gaming=true" class="btn btn-app">
			<i class="fa fas fa-plus"></i> <?=ADD?>
		</a>
		<a class="btn btn-app">
			<span class="badge bg-red"><?=$count?></span>
			<i class="fa fa-bullhorn"></i> Jeu(x)
		</a>
	</div>
</div>
<div class="col-md-12">
	<div class="panel panel-white">
		<div class="panel-body">
		   <div class="table-responsive">
				<table id="datatableTeam" class="table table-striped jambo_table bulk_action">
					<thead>
						<tr>
							<th># ID</th>
							<th>Nom</th>
							<th>Options</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th># ID</th>
							<th>Nom</th>
							<th>Options</th>
						</tr>
					</tfoot>
					<tbody>
					<?php
					foreach ($data as $k => $v):
						?>
						<tr>
							<td><?=$v->id?></td>
							<td><?=$v->name?></td>
							<td>
								<a href="/games/edit/<?=$v->id?>?management&gaming=true>" class="btn btn-small btn-success"><i class="fas fa-pen"></i></a>
								<a href="#" data-toggle="modal" data-target="#modal_<?=$v->id?>" class="btn btn-danger btn-small"><i class="fas fa-trash-alt"></i></a>
								<div class="modal fade" id="modal_<?=$v->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="exampleModalLabel"><?=$v->name?></h4>
											</div>
											<div class="modal-body">Confirmer la suppression du jeu : <?=$v->name?></div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												<button onclick="window.location.href='/games/delgame/<?=$v->id?>?management&gaming=true'" type="button" class="btn btn-primary">Supprimer</button>
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