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
<div id="bel_cms_members_index" class="section_bg card">
	<div class="card-header" style="background-color:<?=COLOR_TOP;?>"><?=MEMBERS?></div>
	<div class="card-body" style="background-color:<?=COLOR_BODY;?>">
		<table class="table <?=TYPE_TABLE;?>" style="color:<?=COLOR_TEXT;?>">
			<thead>
				<tr>
					<th><?=USERNAME?></th>
					<th><?=LAST_VISIT?></th>
					<th><?=LOCATION?></th>
					<th><?=GENDER?></th>
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
							<td><?=Common::TransformDate($v->last_visit, 'FULL', 'MEDIUM')?></td>
							<td><span class="<?=$flag?>"></span><span style="padding-left: 10px;"><?=$country?></span></td>
							<td><?=$gender?></td>
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
