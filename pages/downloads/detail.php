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
$screen = empty($data->screen) ? 'assets/images/no_screen.png' : $data->screen;
?>
<div class="table-responsive">
	<table class="table table-hover table-bordered">
		<tbody>
			<tr>
				<td id="bel_cms_dl_detail_name" colspan="4"><?=$data->name?></td>
			</tr>
			<tr>
				<td rowspan="7" style="max-width:180px">
					<img style="max-width:180px" id="bel_cms_dl_detail_img" src="<?=$screen?>" alt="dls_screen">
				</td>
			</tr>
			<tr class="">
				<td>Info hash MD5</td>
				<td colspan="2"><?=md5_file(($data->download))?></td>
			</tr>
			<tr>
				<td><?=SIZE?></td>
				<td>BDD : <?=Common::ConvertSize($data->size)?></td>
				<td>Réel : <?=Common::ConvertSize(filesize($data->download))?></td>
			</tr>
			<tr>
				<td>Télécharger</td>
				<td><?=$data->dls?></td>
				<td><?=(int)$data->view?> <i class="fa fa-eye"></i></td>
			</tr>
			<tr>
				<td>Type mime</td>
				<td colspan="2"><?=mime_content_type($data->download)?></td>
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