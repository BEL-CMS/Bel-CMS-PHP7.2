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
				<div class="belcms_title">Liens Social</div>
					<form action="user/submitsocial" method="post" class="belcms_section_user_main_form">
						<div class="belcms_form_group">
							<label class="col-sm-12 col-form-label"><i class="fab fa-facebook-square"></i> (Meta) Facebook</label>
							<div class="col-sm-12">
								<input class="form-control" name="facebook" type="text" placeholder="<?=constant('ENTER_YOUR');?> facebook" value="<?=$user->facebook?>" pattern="^[a-z\d\.]{5,}$">
							</div>
						</div>

						<div class="belcms_form_group">
							<label class="col-sm-12 col-form-label"><i class="fab fa-twitter-square"></i> X (Twitter)</label>
							<div class="col-sm-12">
								<input class="form-control" name="twitter" type="text" placeholder="<?=constant('ENTER_YOUR');?> twitter" value="<?=$user->twitter?>" pattern="^[A-Za-z0-9_]{1,15}$">
							</div>
						</div>

						<div class="belcms_form_group">
							<label class="col-sm-12 col-form-label"><i class="fab fa-discord"></i> Discord</label>
							<div class="col-sm-12">
								<input class="form-control" name="discord" type="text" placeholder="<?=constant('ENTER_YOUR');?> Discord" value="<?=$user->discord?>">
							</div>
						</div>

						<div class="belcms_form_group">
							<label class="col-sm-12 col-form-label"><i class="fab fa-pinterest-square"></i> Pinterest</label>
							<div class="col-sm-12">
								<input class="form-control" name="pinterest" type="text" placeholder="<?=constant('ENTER_YOUR');?> pinterest" value="<?=$user->pinterest?>">
							</div>
						</div>

						<div class="belcms_form_group">
							<label class="col-sm-12 col-form-label"><i class="fab fa-linkedin"></i> Linkedin</label>
							<div class="col-sm-12">
								<input class="form-control" name="linkedin" type="text" placeholder="<?=constant('ENTER_YOUR');?> linkedin" value="<?=$user->linkedin?>">
							</div>
						</div>
						<hr>
						<button type="submit" class="belcms_btn belcms_btn_blue">Enregistrer</button>
					</form>
			</div>
		</div>
	</div>
<?php
endif;