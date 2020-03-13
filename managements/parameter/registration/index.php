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
		<h2>Menu Page Blog</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<a href="/registration?management&parameter=true" class="btn btn-app">
			<i class="fa fas fa-home"></i> Accueil
		</a>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-white">
		<div class="panel-body">
		   <div class="table-responsive">
			<table class="table table-striped jambo_table bulk_action">
				<thead>
					<tr>
						<th># ID</th>
						<th>Nom</th>
						<th>Date d'inscription</th>
						<th>Dernière visite</th>
						<th>Options</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th># ID</th>
						<th>Nom</th>
						<th>Date d'inscription</th>
						<th>Dernière visite</th>
						<th>Options</th>
					</tr>
				</tfoot>
				<tbody>
					<?php
					foreach ($user as $k => $v):
						?>
						<tr>
							<td><?=$v->id;?></td>
							<td><?=$v->username;?></td>
							<td><?=$v->date_registration;?></td>
							<td><?=$v->last_visit;?></td>
							<td>
								<a href="registration/edit/<?=$v->id?>?management&page&parameter=true"><i class="fas fa-pen"></i></a> - 
								<a href="#" data-toggle="modal" data-target="#modal_<?=$v->id?>"><i class="fas fa-trash-alt"></i></a>
								<div class="modal fade" id="modal_<?=$v->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="exampleModalLabel"><?=$v->username?></h4>
											</div>
											<div class="modal-body">Confirmer la suppression de l'utilisateur : <?=$v->username?></div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												<button onclick="window.location.href='/registration/del/<?=$v->id?>?management&parameter=true'" type="button" class="btn btn-primary">Confirmer</button>
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
