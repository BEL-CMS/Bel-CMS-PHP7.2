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
<div class="block full">
    <div class="block-title">
        <h2><strong>Télécharments</strong></h2>
    </div>
	<div class="table-responsive">
		<table  class="DataTableBelCMS table table-vcenter table-condensed table-bordered">
			<thead>
				<tr>
					<th># ID</th>
					<th>Nom</th>
					<th>Date de publication</th>
					<th>Auteur</th>
					<th>Options</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th># ID</th>
					<th>Nom</th>
					<th>Date de publication</th>
					<th>Auteur</th>
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
						<td><?=Common::TransformDate($v->date, 'MEDIUM', 'SHORT')?></td>
						<td><?=Users::hashkeyToUsernameAvatar($v->uploader)?></td>
						<td>
							<a href="/downloads/edit/<?=$v->id?>?management&page=true" class="btn btn btn-primary btn-sm mb-1">Edit</a>
							<a href="#" data-toggle="modal" data-target="#modal_<?=$v->id?>" class="btn btn btn-danger btn-sm mb-1">Supprimer</a>
							<div class="modal fade" id="modal_<?=$v->id?>" tabindex="-1" role="dialog" aria-labelledby="DownloadsModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="DownloadsModalLabel"><?=$v->name?></h4>
										</div>
										<div class="modal-body">Confirmer la suppression du fichier : <?=$v->name?></div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
											<button onclick="window.location.href='/downloads/del/<?=$v->id?>?management&page=true'" type="button" class="btn btn-primary">Supprimer</button>
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