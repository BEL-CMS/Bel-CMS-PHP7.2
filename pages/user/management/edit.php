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
if (isset($_SESSION['LOGIN_MANAGEMENT']) && $_SESSION['LOGIN_MANAGEMENT'] === true):
?>
<div class="box-body">
	<a class="btn btn-app" href="User?management">
		<i class="fa fa-users"></i>Utilisateurs
	</a>
	<a class="btn btn-app" href="User/NewUser?management">
		<i class="fa fa-user-plus"></i>Ajouter
	</a>
	<a class="btn btn-app" href="User/Parameter?management">
		<i class="fa fa-cubes"></i>Paramètres
	</a>
</div>

<form action="User/senduser/<?=$private->hash_key?>?management" method="post">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title"><?=constant('PRIVATE')?></h3>
		</div>
		<div class="box-body">
			<div class="form-group">
				<label for="label_name"><?=USERNAME?> :</label>
				<input class="form-control" name="username" type="text" id="label_name" placeholder="Nom d'utilisateur" required="required" value="<?=$private->username?>">
			</div>
			<div class="form-group">
				<label for="label_pass"><?=PASSWORD?> :</label>
				<input class="form-control" name="password" type="password" placeholder="A remplir uniquement en cas de changement !" id="label_pass" autocomplete="new-password" value="">
				<span class="help-block"><?=HELP_NEW_PASSWORD?>
			</div>
			<div class="form-group">
				<label for="label_mail"><?=MAIL?> :</label>
				<input class="form-control" name="email" type="email"  id="label_mail" placeholder="<?=MAIL.' '.constant('PRIVATE')?>" required="required" value="<?=$private->email?>">
			</div>
			<div class="form-group">
				<label for="label_main_groups"><?=MAIN_GROUP?> :</label>
				<select class="form-control" name="main_groups">
				<?php
				foreach (config::GetGroups() as $k => $v):
					$selected = $private->main_groups == $k ? 'selected' : '';
					?>
					<option <?=$selected?> value="<?=$k?>"><?=$v?></option>
					<?php
				endforeach;
				?>
				</select>
			</div>
			<div class="form-group">
				<label><?=GROUPS?> :</label>
				<?php
				foreach (config::GetGroups() as $k => $v):
					$groups  = explode('|', $private->groups);
					$checked = in_array($k, $groups) ? 'checked="checked"' : '';
					?>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<input type="checkbox" name="groups[]" value="<?=$k?>" <?=$checked?>>
								</div>
							</div>
							<input class="form-control" type="text" value="<?=$v?>" readonly>
						</div>
					</div>
					<?php
				endforeach;
				?>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=EDIT?></button>
		</div>
	</div>

	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title"><?=constant('PUBLIC')?></h3>
		</div>
		<div class="box-body">
			<div class="form-group">
				<label for="label_mail_public"><?=MAIL?> :</label>
				<div class="controls">
					<input class="form-control" name="public_mail" type="email" class="span6" id="label_mail_public" placeholder="<?=MAIL.' '.constant('PUBLIC')?>" value="<?=$profil->public_mail?>">
				</div>
			</div>
			<div class="form-group">
				<label for="label_web"><?=WEBSITE?> :</label>
				<div class="controls">
					<input class="form-control" name="websites" type="url" class="span6" id="label_web" placeholder="http://" value="<?=$profil->websites?>">
				</div>
			</div>
			<div class="form-group">
				<label for="label_birthday"><?=BIRTHDAY?> :</label>
				<div class="controls">
					<input id="label_birthday" class="datepicker form-control" name="birthday" type="text" value="<?=$profil->birthday?>">
				</div>
			</div>
			<div class="form-group">
				<label for="label_country"><?=COUNTRY?> :</label>
				<div class="controls">
					<select class="form-control" name="country" class="span6">
						<?php
						foreach (Common::contryList() as $k => $v):
							$selected = $profil->country == $v ? 'selected="selected"' : '';
							echo '<option '.$selected.' value="'.$v.'">'.$v.'</option>';
						endforeach;
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="label_main_groups"><?=GENDER?> :</label>
				<div class="controls">
				<?php
					$profil->gender = mb_strtoupper($profil->gender);
					$genderM = strtoupper($profil->gender) == strtoupper(constant('MALE')) ? 'selected' : '';
					$genderF = strtoupper($profil->gender) == strtoupper(constant('FEMALE')) ? 'selected' : '';
					$genderU = strtoupper($profil->gender) == strtoupper(constant('UNISEXUAL')) ? 'selected' : '';
				?>
					<select class="form-control"  name="gender">
						<option <?=$genderM?> value="male"><?=constant('MALE')?></option>
						<option <?=$genderF?> value="female"><?=constant('FEMALE')?></option>
						<option <?=$genderU?> value="unisexual"><?=constant('UNKNOWN')?></option>
					</select>
				</div>
			</div>
			<label for="label_main_groups"><?=DESCRIPTION?> :</label>
			<div class="controls">
				<textarea class="bel_cms_textarea_simple" name="info_text" placeholder="Votre description..."><?=$profil->info_text; ?></textarea>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=EDIT?></button>
		</div>
	</div>

	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title"><?=constant('SOCIAL')?></h3>
		</div>
		<div class="box-body">
			<?php
			foreach ($listSocial as $name):
				$label = defined(strtoupper($name)) ? constant(strtoupper($name)) : ucfirst($name);
			?>
			<div class="form-group">
				<label for="label_<?=$name;?>"><?=$label?> :</label>
				<div class="controls">
					<input class="form-control" name="<?=$name?>" type="text" class="span6" id="label_<?=$label;?>" value="<?=$social->$name?>">
				</div>
			</div>
			<?php
			endforeach;
			?>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=EDIT?></button>
		</div>
	</div>
</form>
<?php
endif;
