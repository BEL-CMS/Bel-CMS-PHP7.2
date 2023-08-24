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
	$user->gender   = mb_strtoupper($user->gender);
	$genderM        = strtoupper($user->gender) == strtoupper(constant('MALE')) ? 'checked="checked"' : '';
	$genderF        = strtoupper($user->gender) == strtoupper(constant('FEMALE')) ? 'checked="checked"' : '';
	$genderU        = strtoupper($user->gender) == strtoupper(constant('UNISEXUAL')) ? 'checked="checked"' : '';
	$user->birthday = Common::DatetimeSQL($user->birthday, false, 'Y-m-d');
	require_once 'nav.php';
?>
	<div id="belcms_section_user_main">
		<div id="belcms_section_user_main_left">
			<div class="belcms_card">
				<div class="belcms_title">Profil</div>
				<form action="user/sendaccount" method="post" class="belcms_section_user_main_form">
					<div class="belcms_form_group">
						<label for="username" class="form-label">Nom d'utilisateur :</label>
						<input class="form-control" name="username" type="text" placeholder="<?=constant('ENTER_NAME_PSEUDO')?>" required="required" value="<?=$user->username?>" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$">
					</div>
					<div class="belcms_form_group">
						<label for="email" class="form-label">Adresse e-mail :</label>
						<input type="email" name="mail" class="form-control" placeholder="Enter email" value="<?=$user->email?>">
						<i class="belcms_form_group_i">L'adresse email ne sera pas affichée publiquement.</i>
					</div>
					<div class="belcms_form_group">
						<label for="birthday" class="form-label">Anniversaire</label>
						<input id="birthday" class="form-control" type="date" name="birthday" value="<?=$user->birthday?>">
					</div>
					<div class="belcms_form_group">
						<label for="country" class="form-label">Pays</label>
						<select name="country" class="form-control">
							<?php
							foreach (Common::contryList() as $k => $v):
								$selected = $user->country == $v ? 'selected="selected"' : '';
								echo '<option '.$selected.' value="'.$v.'">'.$v.'</option>';
							endforeach;
							?>
						</select>
					</div>
					<div class="belcms_form_group">
						<label class="form-label">Genre</label>
						<div class="form-check">
							<input <?=$genderM?> class="form-check-input" type="radio" name="gender" id="male" value="male">
							<label class="form-check-label" for="male"><?=MALE?></label>
						</div>
						<div class="form-check">
							<input <?=$genderF?> class="form-check-input" type="radio" name="gender" id="female" value="female">
							<label class="form-check-label" for="female"><?=FEMALE?></label>
						</div>
						<div class="form-check">
							<input <?=$genderU?> class="form-check-input" type="radio" name="gender" id="nospec" value="unisexual">
							<label class="form-check-label" for="nospec"><?=NO_SPEC?></label>
						</div>
					</div>
					<div class="belcms_form_group">
						<label for="websites" class="form-label">SiteWeb</label>
						<input class="form-control" name="websites" type="text" placeholder="Votre Site Web" value="<?=$user->websites?>" pattern="https?://.+">
					</div>
					<div class="belcms_form_group belcms_form_group_submit">
						<button type="submit" class="belcms_btn belcms_btn_blue"><?=SEND?></button>
					</div>
				</form>
			</div>

		</div>
		<div id="belcms_section_user_main_right">
			<div class="belcms_card">
				<div class="belcms_title">Avatar</div>
				<div id="belcms_section_user_main_right_avatar">
					<img src="<?=$user->avatar?>">
				</div>
				<div class="belcms_bg_grey_w belcms_pb_10">
					<a href="user/avatar" class="belcms_btn belcms_btn_blue"><?=MODIFY?></a>
				</div>
			</div>
		</div>
	</div>
<?php
endif;