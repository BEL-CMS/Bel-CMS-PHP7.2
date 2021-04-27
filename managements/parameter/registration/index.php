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
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="block full">
		    <div class="block-title">
		        <h2><strong>Centre utilisateurs</strong></h2>
		    </div>
			<div class="table-responsive">
				<table  class="DataTableBelCMS table table-vcenter table-condensed table-bordered">
					<thead>
						<tr>
							<th class="">#ID</th>
							<th class="">Nom</th>
							<th class="">e-mail</th>
							<th class="">Dernière visite</th>
							<th class="">Date d'inscription</th>
							<th class="">Options</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($user as $k => $v):
							?>
							<tr>
								<td><?=$v->id;?></td>
								<td><?=$v->username;?></td>
								<td><?=$v->email?></td>
								<td><?=$v->last_visit;?></td>
								<td><?=$v->date_registration;?></td>
								<td>
									<a href="/registration/edit/<?=$v->id?>?management&page&parameter=true" class="btn btn btn-primary btn-sm mb-1">Edit</a>
									<?php
									if ($v->id != 1):
									?>
									<a href="#" data-toggle="modal" data-target="#modal_<?=$v->id?>" class="btn btn btn-danger btn-sm mb-1">Supprimer</a>
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
													<button onclick="window.location.href='/registration/del/<?=$v->hash_key?>?management&parameter=true'" type="button" class="btn btn-primary">Confirmer</button>
												</div>
											</div>
										</div>
									</div>
									<?php
									endif
									?>
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