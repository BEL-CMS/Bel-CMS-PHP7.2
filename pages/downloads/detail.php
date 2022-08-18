<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.1
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
$screen = empty($data->screen)     ? 'assets/images/no_screen.png' : $data->screen;
$md5    = is_file($data->download) ? md5_file(($data->download)) : null;
$mime   = is_file($data->download) ? mime_content_type(($data->download)) : null;
$size   = is_file($data->download) ? Common::ConvertSize(filesize($data->download)) : null;
?>
<div class="section_bg">
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<tbody>
				<tr>
					<td id="bel_cms_dl_detail_name" colspan="4"><?=$data->name?></td>
				</tr>
				<tr>
					<td rowspan="7" style="max-width:180px">
						<?=$data->description?>
					</td>
				</tr>
				<tr class="">
					<td>Info hash MD5</td>
					<td colspan="2"><?=$md5?></td>
				</tr>
				<tr>
					<td><?=SIZE?></td>
					<td>BDD : <?=Common::ConvertSize($data->size)?></td>
					<td>Réel : <?=$size?></td>
				</tr>
				<tr>
					<td>Télécharger</td>
					<td><?=$data->dls?></td>
					<td><?=(int)$data->view?> <i class="fa fa-eye"></i></td>
				</tr>
				<tr>
					<td>Type mime</td>
					<td colspan="2"><?=$mime?></td>
				</tr>
				<tr>
					<td>Date</td>
					<td colspan="5"><?=Common::TransformDate($data->date, 'FULL', 'SHORT')?></td>
				</tr>
				<tr>
					<td>Uploader</td>
					<td colspan="2"><?=Users::hashkeyToUsernameAvatar($data->uploader)?></td>
				</tr>
				<tr>
					<td style="text-align: center;" colspan="4"><a href="Downloads/getDl/<?=$data->id?>">Télécharger</a></td>	
				</tr>
			</tbody>
		</table>
	</div>
</div>