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

if (isset($_SESSION['LOGIN_MANAGEMENT']) && $_SESSION['LOGIN_MANAGEMENT'] === true):
?>
<div class="box-body">
	<a class="btn btn-app" href="User?management">
		<i class="fa fa-users"></i><?=USERS?>
	</a>
	<a class="btn btn-app" href="User/NewUser?management">
		<i class="fa fa-user-plus"></i><?=ADD?>
	</a>
	<a class="btn btn-app" href="User/Parameter?management">
		<i class="fa fa-cubes"></i><?=PARAMETERS?>
	</a>
</div>


<form action="User/send?management" method="post">
	<div class="box">
		<div class="box-body">
			<div class="form-group">
				<label class="control-label" for="label_nb"><?=NB_USER?></label>
				<div class="controls">
					<input class="form-control" name="MAX_USER" type="number" id="label_nb" value="<?=$_SESSION['pages']->user->config['MAX_USER']?>" min="1" max="16">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label" for="label_nb_admin"><?=NB_USER_ADMIN?></label>
				<div class="controls">
					<input class="form-control" name="MAX_USER_ADMIN" type="number" id="label_nb_admin" value="<?=$_SESSION['pages']->user->config['MAX_USER_ADMIN']?>" min="1" max="25" disabled>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<input type="hidden" name="send" value="parameter">
			<button type="submit" class="btn btn-primary"><?=SAVE?></button>
		</div>
	</div>
</form>
<?php
endif;
