<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.2
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit('<!doctype html><html><head><meta charset="utf-8"><title>BEL-CMS : Error 403 Forbidden</title><style>h1{margin: 20px auto;text-align:center;color: red;}p{text-align:center;font-weight:bold;</style></head><body><h1>HTTP Error 403 : Forbidden</h1><p>You don\'t permission to access / on this server.</p></body></html>');
}
if (Users::isLogged() === true):
	$user->gender = mb_strtoupper($user->gender);
	$genderM = strtoupper($user->gender) == strtoupper(constant('MALE')) ? 'checked="checked"' : '';
	$genderF = strtoupper($user->gender) == strtoupper(constant('FEMALE')) ? 'checked="checked"' : '';
	$genderU = strtoupper($user->gender) == strtoupper(constant('UNISEXUAL')) ? 'checked="checked"' : '';
?>
<nav id="belcms_user_nav">
	<ul>
		<li>
			<a href="User">Mon Compte</a>
		</li>
		<li>
			<a href="User/modifications">Confidentialité</a>
		</li>
		<li>
			<a href="User/secure">Sécurité</a>
		</li>
		<li>
			<a href="User/Avatars">Avatars</a>
		</li>
		<li>
			<a href="User/Social">Social</a>
		</li>
	</ul>
</nav>
<form action="user/sendaccount" method="post" id="formModif">
	<div class="content">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12" style="margin-bottom: 20px;">
				<h2 id="user_h2">Modifications</h2>
				<div id="user_detail">
					<table id="belcms_user_table" class="table">
						<tr>
							<td>E-mail Public</td>
							<td><input type="email" name="mail" class="form-control" placeholder="Enter email" value="<?=$user->email?>"></td>
						</tr>
						<tr>
							<td>SiteWeb</td>
							<td><input class="form-control" name="websites" type="text" placeholder="Votre Site Web" value="<?=$user->websites?>" pattern="https?://.+"></td>
						</tr>
						<tr>
							<td>Genre</td>
							<td>
								<select name="gender">
									<option></option>
									<option <?=$genderM?>><?=MALE?></option>
									<option <?=$genderF?>><?=FEMALE?></option>
									<option <?=$genderU?>><?=NO_SPEC?></option>
								</select>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<a href="#" class="btn color-bg" onclick="document.getElementById('formModif').submit();"><span>Enregistrer le formulaire</span></a>
		</div>
	</div>
</form>
<?php
endif;