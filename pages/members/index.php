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
<section id="belcms-members">
	<h2><?=MEMBERS?></h2>
	<div class="belcms-table">
		<div class="belcms-table-tr belcms-table-tr-title">
			<div class="belcms-table-th">
				<?=USERNAME?>
			</div>
			<div class="belcms-table-th">
				<?=LAST_VISIT?>
			</div>
			<div class="belcms-table-th">
				<?=LOCATION?>
			</div>
			<div class="belcms-table-th">
				<?=GENDER?>
			</div>
			<div class="belcms-table-th">
				<?=WEBSITE?>
			</div>
		</div>
		<?php
		if (empty($members)):
			?>
			<div class="belcms-table-td center">Aucun utilisateur</div>
			<?php
		else:
		foreach ($members as $k => $v):
			if (!empty($v->profils)) {
				if ($v->profils->gender == 'male') {
					$gender = MALE;
				} else if ($v->profils->gender == 'female') {
					$gender = FEMALE;
				} else {
					$gender = UNISEXUAL;
				}
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
			?>
			<div class="belcms-table-tr">
				<div class="belcms-table-td"><a href="Members/View/<?=$v->username?>"><?=$v->username?></a></div>
				<div class="belcms-table-td"><?=Common::TransformDate($v->last_visit, 'FULL', 'MEDIUM')?></div>
				<div class="belcms-table-td">
					<span class="<?=$flag?>"></span>
					<span style="padding-left: 10px;"><?=$country?></span>
				</div>
				<div class="belcms-table-td"><?=$gender?></div>
				<div class="belcms-table-td"><?=$websites?></div>
			</div>
		<?php
		endforeach;
		endif;
		?>
	</div>
</section>
<?php
if (!empty($pagination)):
?>
	<div class="card-footer">
		<?=$pagination?>
	</div>
<?php
endif;
