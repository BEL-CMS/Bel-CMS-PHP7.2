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
					<div>
						<h3 class="belcms_h3_input_lf">Mot de passe :</h3>
						<input name="password_old" type="password" class="bel_cms_input" value="" autocomplete="off" required="required">
						<i class="belcms_form_group_i">* Entrer votre ancien mot de passe.</i>
					</div>
					<div>
						<h3 class="belcms_h3_input_lf">Nouveau mot de passe :</h3>
						<input name="password_new" type="text" required="required" class="bel_cms_input" value="" rel="gp" data-character-set="a-z,A-Z,0-9,#" data-size="6">
						<i class="belcms_form_group_i">* Mot de passe (6 caractère minimum).</i>
						<a type="button" class="belcms_btn belcms_btn_blue getNewPass">Générateur</a>
					</div>
					<div class="belcms_form_group_submit">
						<button type="submit" class="belcms_btn">Enregistrer</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php
endif;