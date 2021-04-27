<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.3
 * @link http://www.bel-cms.be
 * @link http://www.stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2016 Bel-CMS
 * @author Stive - mail@stive.eu
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

$count = BelCMSConfig::getGroups();
$i = 0;
foreach ($count as $key => $value) {
	$i++;
}
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
        <div class="block">

            <div class="block-title">
                <h2>Liste des groupes</h2>
            </div>
			<table class="table table-responsive">
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
				foreach (BelCMSConfig::getGroups() as $k => $v):
					if ($v == 1 and $v == 2) {
						$colspan = 'colspan="2"';
					} else {
						$colspan = '';
					}
					?>
					<tr>
						<td><?=$v?></td>
						<td><?=$k?></td>
						<td <?=$colspan?>>
							<?php
							if ($v != 1 and $v != 2):
							?>
							<a href="/groups/edit/<?=$v?>?management&parameter=true" class="btn btn btn-primary btn-sm mb-1">Edit</a>
							<a href="#" data-toggle="modal" data-target="#modal_<?=$v?>" class="btn btn btn-danger btn-sm mb-1">Supprimer</a>
							<div class="modal fade" id="modal_<?=$v?>" tabindex="-1" role="dialog">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title"><?=$k?></h4>
										</div>
										<div class="modal-body">Confirmer du groupe : <?=$k?></div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
											<button onclick="window.location.href='/groups/detele/<?=$v?>?management&parameter=true'" type="button" class="btn btn-primary">Supprimer</button>
										</div>
									</div>
								</div>
							</div>
							<?php
							endif;
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