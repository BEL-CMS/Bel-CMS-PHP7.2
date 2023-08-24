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
						<div class="belcms_form_group">
							<label class="form-label">Email</label>
							<input disabled type="email" class="form-control" value="<?=$user->email?>">
							<small id="emailHelp" class="form-text text-muted">L'adresse email priver ne sera pas affichée publiquement.</small>
						</div>
						<div class="belcms_form_group">
							<label class="form-label">Date D'enregistrement</label>
							<input disabled type="datetime" class="form-control" value="<?=$user->date_registration?>">
							<small id="emailHelp" class="form-text text-muted">la date d'inscription au site, il est possible qu'il soit utiliser publiquement.</small>
						</div>
						<div class="belcms_form_group">
							<label class="form-label">Dernère visite</label>
							<input disabled type="datetime" class="form-control" value="<?=$user->last_visit?>">
							<small id="emailHelp" class="form-text text-muted">la date de la dernière visite au site, il est possible qu'il soit utiliser publiquement.</small>
						</div>
						<hr>
						<div class="belcms_form_group">
							<?php
							$all_groups = Secures::getGroups();
							$name_group = $all_groups[current($user->groups)];
							$a = defined($name_group) ? constant($name_group) : $name_group;
							?>
							<label class="form-label">Groupe principal</label>
							<select disabled class="form-control">
								<option value="<?=$user->main_groups?>"><?=$a?></option>
							</select>
						</div>
						<div class="belcms_form_group">
							<label class="form-label">Groupe Secondaire</label>
							<select class="form-control">
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
	</div>
<?php
endif;