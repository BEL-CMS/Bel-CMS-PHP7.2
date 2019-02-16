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

<section id="bel_cms_forum_main">
	<?php
	foreach ($data as $v):
	?>
	<div class="bel_cms_forum_main_fm">
		<h2><?=$v->title?></h2>
		<h3><sub><?=$v->subtitle?></sub></h3>
		<div class="clear_forum"></div>
		<?php
		foreach ($v->threads as $k => $threads):
			$sj = $threads->count == 0 ? 'Sujet' : 'Sujets';
			$last = $threads->last;

			if (!empty($threads->last)) {
				$last = $threads->last;
				$hash_key = $last['author'];
				if (!empty($hash_key) && strlen($hash_key) == 32) {
					if (Users::ifUserExist($hash_key)) {
						$user     = Users::getInfosUser($hash_key);
						$username = $user[$hash_key]->username;
						if (is_file($user[$hash_key]->avatar)) {
							$avatar   = $user[$hash_key]->avatar;
						} else {
							$username = 'Utilisateur supprimer';
							$avatar   = 'assets/images/default_avatar.jpg';
						}
					} else {
						$username = 'Utilisateur supprimer';
						$avatar   = 'assets/images/default_avatar.jpg';
					}
				} else {
					$last['author'] = 'Utilisateur supprimer';
					$avatar   = 'assets/images/default_avatar.jpg';
				}
				
			} else {
				$username = 'Utilisateur supprimer';
				$last['title']     = false;
				$last['date_post'] = false;
				$last['author']    = 'Utilisateur supprimer';
				$avatar   = 'assets/images/default_avatar.jpg';
			}
			$linkThreads = 'Forum/Threads/'.$threads->title.'/'.$threads->id;
			$last['id'] = empty($last['id']) ? '' : (int) $last['id'];
		?>
		<div class="bel_cms_forum_main_tds">
			<div class="bel_cms_forum_main_tds_ico">
				<i class="<?=$threads->icon?>"></i>
			</div>
			<div class="bel_cms_forum_main_tds_title">
				<span><a href="<?=$linkThreads?>" title="<?=$threads->title?>"><?=$threads->title?></a></span>
				<span><?=$threads->subtitle?></span>
			</div>
			<div class="bel_cms_forum_main_tds_sj">
				<span><?=$threads->count?> <?=$sj?></span>
			</div>
			<img class="bel_cms_forum_main_tds_img" src="<?=$avatar?>" alt="avatar">
			<div class="bel_cms_forum_main_tds_last">
				<?php
				if ($last['title'] !== false):
				?>
				<h4><a href="Forum/Post/<?=$last['title']?>/<?=$last['id']?>" title=""><?=Common::truncate($last['title'], 20)?></a></h4>
				<span><i class="fa fa-user"></i> <a href="Members/View/<?=$username?>" title=""><?=$username?></a> <i class="fa fa-clock-o"></i> <?=Common::TransformDate($last['date_post'], 'MEDIUM', 'NONE')?></span>
				<?php
				else:
				?>
				<h5>Aucun post</h5>
				<?php
				endif;
				?>
			</div>
		</div>
		<?php
		endforeach;
		?>
	</div>
	<?php
	endforeach
	?>
</section>