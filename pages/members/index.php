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
<div id="bel_cms_members_index" class="card">
	<div class="card-header"><?=MEMBERS?></div>
	<div class="card-body">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th><?=USERNAME?></th>
					<th class="d-none d-lg-block"><?=LAST_VISIT?></th>
					<th><?=LOCATION?></th>
					<th class="d-none d-lg-block"><?=GENDER?></th>
					<th><?=WEBSITE?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (empty($members)) {
					?>
					<tr>
						<td colspan="6">Aucun utilisateur</td>
					</tr>
					<?php
				} else {
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
						<tr>
							<td><a href="Members/View/<?=$v->username?>"><?=$v->username?></a></td>
							<td class="d-none d-lg-block"><?=Common::TransformDate($v->last_visit, 'FULL', 'MEDIUM')?></td>
							<td><span class="<?=$flag?>"></span><span style="padding-left: 10px;"><?=$country?></span></td>
							<td class="d-none d-lg-block"><?=$gender?></td>
							<td><?=$websites?></td>
						</tr>
					<?php
					endforeach;
				}
				?>
			</tbody>
		</table>
	</div>
	<?php
	if (!empty($pagination)):
	?>
		<div class="card-footer">
			<?=$pagination?>
		</div>
	<?php
	endif;
	?>
</div>
