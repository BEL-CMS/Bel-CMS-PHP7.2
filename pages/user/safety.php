<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.2.0
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2015-2023 Bel-CMS
 * @author Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
if (Users::isLogged() === true):
	require_once 'nav.php';
?>

	<div id="belcms_section_user_safety">
		<div id="belcms_section_user_safety_card">
			<div class="belcms_card">
				<div class="belcms_title">Confidentialité</div>
				<form class="belcms_section_user_main_form">
					<div>
						<h3 class="belcms_h3_input_lf">Adresse e-mail privé :</h3>
						<input disabled type="email" class="bel_cms_input" value="<?=$user->email?>">
						<i class="belcms_form_group_i">* L'adresse email ne sera jamais affichée publiquement.</i>
					</div>
					<div>
						<h3 class="belcms_h3_input_lf">Date D'enregistrement :</h3>
						<input disabled type="datetime" class="bel_cms_input" value="<?=$user->date_registration?>">
						<i class="belcms_form_group_i">* la date d'inscription au site, il est possible qu'il soit utiliser publiquement.</i>
					</div>
					<div>
						<h3 class="belcms_h3_input_lf">Dernère visite :</h3>
						<input disabled type="datetime" class="bel_cms_input" value="<?=$user->last_visit?>">
						<i class="belcms_form_group_i">* la date de la dernière visite au site, il est possible qu'il soit utiliser publiquement.</i>
					</div>
					<div>
						<?php
						$all_groups = Secures::getGroups();
						$name_group = $all_groups[current($user->groups)];
						$a = defined($name_group) ? constant($name_group) : $name_group;
						?>
						<h3 class="belcms_h3_input_lf">Groupe principal :</h3>
						<select disabled class="bel_cms_input">
							<option value="<?=$user->main_groups?>"><?=$a?></option>
						</select>
					</div>
					<div>
						<h3 class="belcms_h3_input_lf">Groupe Secondaire :</h3>
						<select class="bel_cms_input">
							<?php
							sort($user->groups);
							foreach ($user->groups as $k => $v):
								$all_groups = Secures::getGroups();
								$name_group = $all_groups[$v];
								$a = defined($name_group) ? constant($name_group) : $name_group;
								?>
								<option value="<?=$v?>"><?=$a?></option>
								<?php
							endforeach;
							?>
						</select>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php
endif;