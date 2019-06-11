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
<section id="bel_cms_forum_threads">
	<?php
		if (Users::getInfosUser($_SESSION['USER']['HASH_KEY']) !== false):
			?>
			<div class="headline">
				<div class="pull-right">
					<a data-toggle="tooltip" title="<?=NEW_THREAD?>" href="Forum/NewThread/<?=$id?>" class="btn btn-info btn-icon-left"><i class="fas fa-plus"></i> <?=NEW_THREAD?></a>
				</div>
			</div>
		<?php	
		endif;
	if (empty($threads)):
		Notification::infos('Aucun sujet disponible dans la base de données', 'Forum');
	else:
	?>
	<div class="bel_cms_forum_main_cat">
		<div class="bel_cms_forum_main_cat_title">
			<h1>kjhyikyhik</h1>
		</div>
		<div style="padding: 10px;">
			<?php
				foreach ($threads as $k => $v):
					?>
					<div class="bel_cms_forum_main_cat_inc">
						<div class="bel_cms_forum_main_cat_inc_ico">
							<i class="fa fa-comments"></i>
						</div>
						<div class="bel_cms_forum_main_cat_inc_title">
							<h3><a href="Forum/Post/<?=$v->title?>/<?=$v->id?>"><?=$v->title?></a></h3>
							<span><i class="fa fa-user-circle"></i> <?=Users::hashkeyToUsernameAvatar($v->author)?> <i class="fa fa-clock-o" aria-hidden="true"></i> <?=Common::TransformDate($v->date_post, 'MEDIUM', 'SHORT')?></span>
						</div>
						<div class="bel_cms_forum_main_cat_inc_activity">
							<div class="bel_cms_forum_main_cat_inc_activity_avatar">
								<img src="<?=Users::hashkeyToUsernameAvatar($v->author, 'avatar')?>">
							</div>
							<div class="bel_cms_forum_main_cat_inc_activity_sujet">
								<span><?=LAST_POST.' '.BY?> <?=Users::hashkeyToUsernameAvatar($v->last->author)?></span>
								<span><i class="fa fa-clock-o"></i> <?=Common::TransformDate($v->last->date_post, 'MEDIUM', 'SHORT')?></span>
							</div>
						</div>
						<div class="bel_cms_forum_main_cat_inc_sj">
							<span><i class="fa fa-eye"></i> <?=$v->options['view']?></span>
							<span><i class="fas fa-exchange-alt"></i> <?=$v->options['post']?></span>
						</div>
					</div>
					<?php
				endforeach;
			?>
		</div>
	</div>
	<?php
	endif;
	?>
</section>
<?php
