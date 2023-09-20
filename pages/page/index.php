<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.2.2
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
if (!empty($data)):
?>
<div id="belcms_section_page_main">
	<div class="belcms_card">
		<div class="bel-cms-pages_title">Page(s)</div>
	</div>
	<div class="belcms_section_page_detail_infos">
		<ul>
			<?php
			foreach ($data as $k => $v):
			?>
			<li><a href="page/subpage/<?=$v->id?>/<?=$v->name?>"><?=$v->name?>: <i><?=$v->count?></i></a></li>
			<?php
			endforeach;
			?>
		</ul>
	</div>
</div>
<?php
endif;
if (!empty($sub)):
?>
<div class="belcms_card">
	<div class="bel-cms-pages_title">Page(s) : Interne</div>
</div>
	<div class="belcms_section_page_detail_infos">
		<ul>
			<?php
			foreach ($sub as $k => $v):
			?>
			<li><a href="page/intern/<?=$v?>"><?=$v?></a></li>
			<?php
			endforeach;
			?>
		</ul>
	</div>
</div>
<?php
endif;
if (empty($data) and empty($sub)):
Notification::warning('Aucune page de disponible', 'Pages');
endif;