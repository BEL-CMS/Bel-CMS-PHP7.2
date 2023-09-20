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
<div id="belcms_section_downloads_main">
	<span class="bel-cms-pages_title"><?=DOWNLOADS;?> - <?=$name?></span>
	<div id="belcms_section_downloads_category">
		<?php
		if (count($data) != 0) {
		?>
		<ul id="belcms_section_downloads_nav_ul">
			<?php
			foreach ($data as $a => $b):
				if (!is_file($b->screen->download)):
					$b->screen = '/pages/downloads/no_image.png';
				endif;
				?>
				<li class="belcms_section_downloads_nav_ul_li">
					<div class="belcms_section_downloads_nav_ul_left">
						<img src="<?=$b->screen;?>" title="logo_<?=$b->name;?>">
					</div>
					<div class="belcms_section_downloads_nav_ul_right">
						<a href="downloads/detail/<?=$b->id?>/<?=$b->name?>"><?=$b->name;?></a>
				
						<span>Taille : <?=Common::ConvertSize($b->size)?></span>
						<span class="belcms_section_downloads_desc"><?=$b->description?></span>
						<a class="belcms_section_downloads_nav_ul_right_dl belcms_btn belcms_bg_blue" href="downloads/detail/<?=$b->id;?>/<?=$b->name;?>">Voir</a>
					</div>
				</li>
			<?php
			endforeach;
		?>
		</ul>
		<?php
		} else {
			Notification::infos('Aucun téléchargement dans la catégorie.');
		}
		?>
	</div>
</div>
