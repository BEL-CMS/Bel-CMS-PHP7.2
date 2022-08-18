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
<section id="belcms_members">
<?php
foreach ($members as $k => $v):
	if (!empty($v->profils)) {
		$country  = $v->profils->country;
		$websites = empty($v->profils->websites) ? '<i class="fa fa-link"></i>' : '<a href="'.$v->profils->websites.'"><i class="fa fa-link"></i></a>';
		$flag = array_search($country, Common::contryList());
		$flag = 'flag-icon flag-icon-'.strtolower($flag);
	} else {
		$gender   = '-';
		$country  = '-';
		$websites = '<i class="fa fa-link"></i>';
		$flag     = '';
	}
	$colorGroup = Users::colorUsername($v->hash_key);
	$nameGroup  = BelCMSConfig::getGroups(true);
	$idGroup    = $v->main_groups;
	$avatar     = empty($v->avatar) ? 'assets/images/default_avatar.jpg' : $v->avatar;
	?>
	<div class="belcms_members_section col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
		<span class="badge" style="background-color: <?=$colorGroup?>; color: #FFF;"><?=$nameGroup->$idGroup['name']?></span>
		<div class="belcms_members_avatar">
			<img src="<?=$avatar;?>" alt="avatar" class="rounded-circle border border-light">
		</div>
		<div class="belcms_members_infos">
			<div class="belcms_members_infos_col">
				<p><strong>Pseudo</strong></p>
				<p><?=$v->username?></p>
			</div>
			<div class="belcms_members_infos_col">
				<p><strong>Site-Web</strong></p>
				<p><?=$websites?></p>
			</div>
			<div class="belcms_members_infos_col">
				<p><strong>Pays</strong></p>
				<p><i class="<?=$flag?>"></i></p>
			</div>
		</div>
		<a href="members/view/<?=$v->username?>" class="btn btn-secondary btn-lg btn-block">Voir le profile</a>
	</div>
<?php
endforeach;
?>
	<?php
	if (!empty($pagination)):
	?>
		<div class="card-footer">
			<?=$pagination?>
		</div>
	<?php
	endif;
	?>
</section>
