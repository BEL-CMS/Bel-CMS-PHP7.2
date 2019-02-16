<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
 * @link http://www.bel-cms.be
 * @link http://www.stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2016 Bel-CMS
 * @author Stive - mail@stive.eu
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
?>
<section id="bel_cms_forum_threads">
	<h2><?=$title?></h2><a style="float: right;" href="Forum/NewThread/<?=$id?>" class="btn btn-primary btn-icon-left"><i class="fa fa-comments"></i> Nouveau sujet</a>
	<?php
	foreach ($post as $k => $v):
		$hash_key = $v->last['author'];
		if (!empty($hash_key) && strlen($hash_key) == 32) {
			if (Users::ifUserExist($hash_key)) {
				$user     = Users::getInfosUser($hash_key);
				$username = $user[$hash_key]->username;
				if (is_file($user[$hash_key]->avatar)) {
					$avatar   = $user[$hash_key]->avatar;
				} else {
					$avatar   = 'assets/images/default_avatar.jpg';
				}
			} else {
				$username = 'Utilisateur supprimer';
				$avatar   = 'assets/images/default_avatar.jpg';
			}
		} else {
			$username = 'Aucune réponse';
			$avatar   = 'assets/images/default_avatar.jpg';
		}
	?>
		<div class="bel_cms_forum_threads_fm">
			<div class="bel_cms_forum_threads_tds_ico">
				<i class="fa fa-comments"></i>
			</div>
			<div class="bel_cms_forum_threads_tds_title">
				<span><a href="Forum/Post/<?=$v->title?>/<?=$v->id?>" title="<?=$v->title?>"><?=$v->title?></a></span>
				<span><i class="fa fa-user-circle"></i> <?=$v->author?> <i class="fa fa-clock-o"></i> <?=$v->date_post?></span>
			</div>
			<div class="bel_cms_forum_threads_tds_sj">
				<span><i class="fa fa-eye"></i> <?=$v->options['view']?></span>
				<span><i class="fa fa-exchange"></i> <?=$v->options['post']?></span>
			</div>
			<?php if ($username == 'Aucune réponse'): ?>
				<img class="bel_cms_forum_threads_tds_img" src="<?=$avatar?>" alt="avatar">
			<?php
			else:
			?>
			<img class="bel_cms_forum_threads_tds_img" src="<?=$avatar?>" alt="avatar">
			<?php
			endif;
			?>	
			<id class="bel_cms_forum_threads_tds_last">
				<?php if ($username == 'Aucune réponse'): ?>
					<span>Aucune réponse</span>
				<?php
				else:
				?>
				<span><?=$username?></span>
				<span><?=Common::TransformDate($v->last['date_post'], 'MEDIUM', 'MEDIUM')?></span>				
				<?php
				endif;
				?>
			</id>
		</div>
	<?php
	endforeach;
	?>
	</div>
</section>
