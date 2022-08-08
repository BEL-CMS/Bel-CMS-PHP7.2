<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2022 Bel-CMS
 * @author Stive - stive@determe.be
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
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Groupes</h3>
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
		  		<i class="fas fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="card-body">
		<?php
		foreach (BelCMSConfig::getGroups() as $k => $v):
			if ($v['id'] == 1 or  $v['id'] == 2) {
				$ico = "fa-arrow-down-up-lock";
			} else {
				$ico = "fa-arrow-down-up-across-line";
			}
			?>
			<div class="info-box col-md-4">
				<span class="info-box-icon" style="color:#FFF;background-color:<?=$v['color'];?>"><i class="fa-solid <?=$ico;?>"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?=$k?></span>
					<span class="info-box-number">
						<a href="/groups/edit/<?=$v['id']?>?management&users" class="btn btn btn-primary btn-sm mb-1">Edit</a>
					<?php
					if ($v['id'] != 1 and $v['id'] != 2):
					?>
					<a href="#" data-toggle="modal" data-target="#modal_<?=$v['id']?>" class="btn btn btn-danger btn-sm mb-1">Supprimer</a>
					<div class="modal fade" id="modal_<?=$v['id']?>" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title"><?=$k?></h4>
								</div>
								<div class="modal-body">Confirmer du groupe : <?=$k?></div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
									<button onclick="window.location.href='/groups/detele/<?=$v['id']?>?management&users'" type="button" class="btn btn-primary">Supprimer</button>
								</div>
							</div>
						</div>
					</div>
					<?php
					endif;
					if (!empty($v['image'])):
					?>
					<div class="float-right">
						<img style="width: 70px; height: 67.8px;position: absolute; right: 15px; top: 8px" src="/<?=$v['image'];?>" alt="<?=$k?>">
					</div>
					<?php
					endif;
					?>
					</span>
				</div>
			</div>
			<?php
		endforeach;
		?>
	</div>
</div>