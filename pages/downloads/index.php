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
<section id="section_bel_cms_donwloads">
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