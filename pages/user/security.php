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
	<div id="belcms_section_user_security">
		<div id="belcms_section_user_security_card">
			<div class="belcms_card">
				<div class="belcms_title">Sécurité</div>
					<form action="user/sendsecurity" method="post" class="belcms_section_user_main_form">
						<div class="belcms_form_group">
							<label for="username" class="form-label">Mot de passe :</label>
							<input name="password_old" type="password" class="form-control" value="" autocomplete="off" required="required">
							<small id="passHelp" class="form-text text-muted">Entrer votre ancien mot de passe.</small>
						</div>
						<div class="belcms_form_group">
							<input name="password_new" type="text" required="required" class="form-control" value="" rel="gp" data-character-set="a-z,A-Z,0-9,#" data-size="6">
							<small id="passHelp" class="form-text text-muted">Entrer votre nouveau mot de passe (6 caractère minimum).</small>
							<br>
							<button type="button" class="belcms_btn belcms_btn_blue getNewPass">Générateur</button>
						</div>
						<div class="belcms_form_group">
							<button type="submit" class="belcms_btn belcms_btn_blue">Enregistrer</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
endif;
