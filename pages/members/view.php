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
<section class="section_bg" id="bel_cms_members_view">
	<div id="bel_cms_members_view_lt">
		<div id="bel_cms_members_view_lt_atr">
			<img src="<?=$data->avatar?>" alt="avatar_<?=$data->username?>">
		</div>
		<div id="bel_cms_members_view_lt_grps">
			<ul>
				<li class="title">Liste des groups</li>
			<?php
			foreach ($data->main_groups as $k => $v):
				if (array_key_exists($v, $groups)):
				?>
				<li><i class="fas fa-angle-right"></i> <?php echo defined($groups[$v]) ? constant($groups[$v]) : $groups[$v] ?></li>
				<?php
				endif;
			endforeach;
			?>
			</ul>
		</div>
	</div>
	<div id="bel_cms_members_view_rt">
		<div class="bel_cms_members_view_rt_block">
			<h3>Information de profil
				<a title="Demande d'amis" data-toggle="tooltip" href="Members/AddFriend/<?=$data->username?>"><i class="fas fa-user-friends"></i></a>
				<a title="message priver" data-toggle="tooltip" href="#"><i class="fas fa-mail-bulk"></i></a></h3>
			<nav>
				<ul>
					<li>
						Nom d'utilisateur<span><?=$data->username?></span>
					</li>
					<li>Date d'inscription<span><?=Common::TransformDate($data->date_registration, 'FULL')?></span>
					</li>
					<li>Dernière activité<span><?=Common::TransformDate($data->last_visit, 'LONG', 'MEDIUM')?></span>
					</li>
				</ul>
			</nav>
		</div>

	</div>
</section>
