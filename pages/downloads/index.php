<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
?>
<section class="section_bg" id="section_bel_cms_donwloads">
	<div class="card mb-3">
		<div class="card-body"><?=DOWNLOADS?></div>
	</div>

	<div class="list-group mb-5">
		<?php 
		foreach ($data as $k => $v):
			?>
			<a href="downloads/category/<?=$v->id?>/<?=$v->name?>" class="list-group-item list-group-item-action">
				<div class="d-flex w-100 justify-content-between">
					<h5 class="mb-1"><?=$v->name?></h5>
					<small><?=$v->count?> fichier(s)</small>
				</div>
				<p class="mb-1"><?=$v->description?></p>
			</a>
			<?php
		endforeach;
		?>
	</div>

</section>