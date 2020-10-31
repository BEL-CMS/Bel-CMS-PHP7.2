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
<div class="row">
	<div class="col-lg-4 col-md-12 col-sm-12">
		<div class="card">
			<div class="list-group list-group-transparent mb-0 mail-inbox">
				<a href="shoutbox?management&widgets=true" class="list-group-item list-group-item-action d-flex align-items-center active">
					<span class="icon mr-3"><i class="fa fas fa-home"></i></span>Accueil
				</a>
				<a href="shoutbox/parameter?management&widgets=true" class="list-group-item list-group-item-action d-flex align-items-center">
					<span class="icon mr-3"><i class="fa fas fa-cogs"></i></span>Configuration
				</a>
				<div class="mt-4 mb-4 ml-4 mr-4">
					<a href="shoutbox/deleteall?management&widgets=true" class="btn btn-danger btn-lg btn-block">Effacer tout</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-8 col-md-12 col-sm-12">
		<div class="card">
			<table id="datatableblog" class="table table-striped jambo_table bulk_action">
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
								<a href="Shoutbox/edit/<?=$v->id?>?management&widgets=true>" class="btn btn btn-primary btn-sm mb-1">Edit</a>
								<a href="#" data-toggle="modal" data-target="#modal_<?=$v->id?>"class="btn btn btn-danger btn-sm mb-1">Supprimer</a>
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