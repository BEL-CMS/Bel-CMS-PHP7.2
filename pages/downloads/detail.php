<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
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
$hash  = md5($dls->link) == $dls->hash ? 'success' : 'danger';
$hashs = md5($dls->link) == $dls->hash ? 'Serveur <i class="fa fa-exchange"></i> Fichier' : 'Erreur';
if (count($dls) > 0):
?>
<div class="table-responsive">
	<table class="table table-hover table-bordered">
		<tbody>
			<tr>
				<td id="bel_cms_dl_detail_name" colspan="4"><?=$dls->name?></td>
			</tr>
			<tr>
				<td rowspan="6" style="width:180px">
					<img id="bel_cms_dl_detail_img" src="<?=$dls->img?>" alt="dls_screen">
				</td>
			</tr>
			<tr class="<?=$hash?>">
				<td>Info hash</td>
				<td><?=md5($dls->link)?></td>
				<td><?=$hashs?></td>
			</tr>
			<tr>
				<td><?=SIZE?></td>
				<td colspan="1"><?=$dls->size?>
				<td colspan="1"><?= $dls->intern === false ? '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Fichier Externe' : ''; ?> </td>
			</tr>
			<tr <?= $dls->ext == 'Inconnu' ? 'class="danger"' : ''?>>
				<td>Extention</td>
				<td><?=$dls->ext?></td>
				<td><i class="fa fa-eye"></i> <?=$dls->countview?></td>
			</tr>
			<tr>
				<td>Date</td>
				<td><?=Common::transformDate($dls->insert_date, true, 'd M Y  H:i')?></td>
				<td><i class="fa fa-cloud-download"></i> <?=$dls->countdl?></td>
			</tr>
			<tr>
				<td>Uploader</td>
				<td colspan="2"><?=$dls->uploader?></td>
			</tr>
		</tbody>
	</table>
</div>
<?php if (!empty($dls->description)): ?>
<blockquote>
	<?=$dls->description?>
</blockquote>
<?php endif; ?>
<a class="btn btn-primary btn-md alertAjaxLink" href="Downloads/GetFile/<?=$dls->id?>&jquery"><i class="fa fa-download"></i> Télécharger</a>
<?php
endif;