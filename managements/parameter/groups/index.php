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
<div class="x_panel">
	<div class="x_title">
		<h2>Menu Page Team</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<a href="/groupd?management&parameter=true" class="btn btn-app">
			<i class="fa fas fa-home"></i> Accueil
		</a>
		<a href="/groups/add?management&parameter=true" class="btn btn-app">
			<i class="fa fas fa-plus"></i> <?=ADD?>
		</a>
		<a class="btn btn-app">
			<span class="badge bg-red"><?=$i?></span>
			<i class="fa fa-bullhorn"></i> Groupes
		</a>
	</div>
</div>
<div class="col-md-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<br />
			<table class="table table-striped jambo_table bulk_action">
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
							<a href="/groups/edit/<?=$v?>?management&parameter=true" class="btn btn-small btn-success"><i class="fas fa-pen"></i></a>
							<a href="#" data-toggle="modal" data-target="#modal_<?=$v?>" class="btn btn-danger btn-small"><i class="fas fa-trash-alt"></i></a>
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