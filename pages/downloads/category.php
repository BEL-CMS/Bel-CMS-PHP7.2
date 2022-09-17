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
<section class="section_bg" id="section_bel_cms_donwloads_cat">
	<div class="card mb-3">
		<div class="card-body"><?=DOWNLOADS?> - <?=$name?></div>
	</div>
	<?php
	if (count($data) != 0) {
	?>
	<div class="list-group mb-5">
		<?php
		foreach ($data as $a => $b):
			?>
			<a href="downloads/detail/<?=$b->id?>/<?=$b->name?>" class="list-group-item list-group-item-action">
				<div class="d-flex w-100 justify-content-between">
					<h5 class="mb-1"><?=$b->name?></h5>
					<small><?=Common::ConvertSize($b->size)?></small>
				</div>
				<p class="mb-1"><?=$b->description?></p>
			</a>
			<?php
		endforeach;
		?>
	</div>
	<?php
	} else {
		Notification::infos('Aucun téléchargement dans cette catégorie');
	}	
	?>

</section>