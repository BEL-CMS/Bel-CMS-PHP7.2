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
<div id="belcms_section_members_view">
	<span class="bel-cms-pages_title"><?=$data->username?></span>
	<div id="belcms_section_members_view_left">
		<div class="belcms_card">
			<div id="belcms_section_members_view_avatar">
				<img src="<?=$data->avatar?>">
			</div>
		</div>
		<div id="bel_cms_members_view_lt_grps">
			<ul>
				<li class="title">Liste des groups</li>
			<?php
			foreach ($data->main_groups as $k => $v):
				if (array_key_exists($v, $groups)):
				?>
				<li>
					<span><?=defined($groups[$v]) ? constant($groups[$v]) : $groups[$v] ?></span>
				</li>
				<?php
				endif;
			endforeach;
			?>
			</ul>
		</div>
	</div>
	<div id="belcms_section_members_view_right">

	</div>

</div>
