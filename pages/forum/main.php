<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
 * @link http://www.bel-cms.be
 * @link http://www.stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2019 Bel-CMS
 * @author Stive - mail@stive.eu
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
?>
<section id="bel_cms_forum_main">
	<?php
	foreach ($forum as $k => $v):
	?>
	<div class="bel_cms_forum_main_cat">
		<div class="bel_cms_forum_main_cat_title">
			<h1><?=$v->title?></h1>
			<h2><?=$v->subtitle?></h2>
		</div>
		<div style="padding: 10px;">
			<?php
			foreach ($v->category as $cat_k => $cat_v):
				if (empty($cat_v->last->title)) {
					$last = '	<span class="last_no">Aucun Post</span>';
				} else {
					$last = '	<span><a href="Forum/Post/Matos à vendre/'.$cat_v->last->id.'">'.$cat_v->last->title.'</a></span>
								<span><i class="fa fa-user"></i> '.Users::hashkeyToUsernameAvatar($cat_v->last->author).' <i class="fa fa-clock-o"></i> '.Common::TransformDate($cat_v->last->date_post, 'MEDIUM', 'NONE').'</span>';
				}
				?>
				<div class="bel_cms_forum_main_cat_inc">
					<div class="bel_cms_forum_main_cat_inc_ico">
						<i class="<?=$cat_v->icon?>"></i>
					</div>
					<div class="bel_cms_forum_main_cat_inc_title">
						<h3><a href="Forum/Threads/<?=$cat_v->title?>/<?=$cat_v->id?>"><?=$cat_v->title?></a></h3>
						<span><?=$cat_v->subtitle?></span>
					</div>
					<div class="bel_cms_forum_main_cat_inc_activity">
						<div class="bel_cms_forum_main_cat_inc_activity_avatar">
							<img src="<?=Users::hashkeyToUsernameAvatar($cat_v->last->author, 'avatar')?>">
						</div>
						<div class="bel_cms_forum_main_cat_inc_activity_sujet">
							<?=$last?>
						</div>
					</div>
					<div class="bel_cms_forum_main_cat_inc_sj">
						<span><?=$cat_v->count?> sujet</span>
					</div>
				</div>
			<?php
			endforeach;
			?>
		</div>
	</div>	
	<?php
	endforeach;
	?>
</section>