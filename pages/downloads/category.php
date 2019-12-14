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
<section id="section_bel_cms_donwloads_cat">
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