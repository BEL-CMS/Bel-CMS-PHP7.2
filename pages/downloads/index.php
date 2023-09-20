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
	<span class="bel-cms-pages_title"><?=DOWNLOADS;?></span>
	<div id="belcms_section_downloads_cat">
		<ul id="belcms_section_downloads_nav">
			<?php
			foreach ($data as $b):
			?>
			<li><a href="downloads/category/<?=$b->id;?>"><?=$b->name;?></a></li>
			<?php
			endforeach;
			?>
		</ul>
	</div>
	<div id="belcms_section_downloads_links">
		<div id="belcms_section_downloads_nav_link">
		<ul id="belcms_section_downloads_nav_ul">
			<?php
			foreach ($data as $v) {
				foreach ($v->dl as $value):
					if (!is_file($value->screen)) {
						$value->screen = '/pages/downloads/no_image.png';
					}
				?>
				<li class="belcms_section_downloads_nav_ul_li">
					<div class="belcms_section_downloads_nav_ul_left">
						<img src="<?=$value->screen;?>" title="logo_<?=$value->name;?>">
					</div>
					<div class="belcms_section_downloads_nav_ul_right">
						<a href="#"><?=$value->name;?></a>
						<span><i><a href="#" style="color: <?=Users::colorUsername($value->uploader);?> !important;">Par <?=Users::getUserName($value->uploader);?></a></i></span>
						<span>Cat : <i><?=$v->name;?></i></span>
						<a class="belcms_section_downloads_nav_ul_right_dl belcms_btn belcms_bg_blue" href="downloads/detail/<?=$value->id;?>/<?=$value->name;?>">Voir</a>
					</div>
				</li>
				<?php
				endforeach;
			?>
			<?php
			}
			?>
		</ul>
	</div>
</div>
<?php