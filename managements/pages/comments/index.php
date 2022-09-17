<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.2
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit('<!doctype html><html><head><meta charset="utf-8"><title>BEL-CMS : Error 403 Forbidden</title><style>h1{margin: 20px auto;text-align:center;color: red;}p{text-align:center;font-weight:bold;</style></head><body><h1>HTTP Error 403 : Forbidden</h1><p>You don\'t permission to access / on this server.</p></body></html>');
}
?>
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Comments</h3>
	</div>
	<div class="card-body">
		<table class="table DataTableBelCMS">
			<thead>
				<tr>
					<th>ID</th>
					<th>Page</th>
					<th>Sous-Page</th>
					<th>Pseudo</th>
					<th>Date</th>
					<th>Options</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (!empty($comments)):
					foreach ($comments as $k => $v):
					?>
					<tr>
						<td><?=$v->id;?></td>
						<td><?=$v->page;?></td>
						<td><?=$v->page_sub;?></td>
						<td><?=Users::hashkeyToUsernameAvatar($v->hash_key)?></td>
						<td><?=$v->date_com;?></td>
						<td>
							<a href="/comments/edit/<?=$v->id?>?management&pages" class="btn btn btn-primary btn-sm mb-1">Edit</a>
							<a href="#" data-toggle="modal" data-target="#modal_<?=$v->id?>" class="btn btn btn-danger btn-sm mb-1">Supprimer</a>
							<div class="modal fade" id="modal_<?=$v->id?>" tabindex="-1" role="dialog" aria-labelledby="DownloadsModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="DownloadsModalLabel"><?=$v->page?></h4>
										</div>
										<div class="modal-body">Confirmer la suppression du commentaire : <?=$v->page?></div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
											<button onclick="window.location.href='/comments/del/<?=$v->id?>?management&pages'" type="button" class="btn btn-primary">Supprimer</button>
										</div>
									</div>
								</div>
							</div>
						</td>
					</tr>
					<?php	
					endforeach;
				else:
					?>
					<tr>
						<td>Aucune données en BDD</td>
					</tr>
					<?php
				endif;
					?>
				</tbody>
			</tbody>
		</table>
	</div>
</div>