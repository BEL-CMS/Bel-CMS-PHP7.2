<?php
/**
 * Bel-CMS [Content management system]
 * @version 1.0.0
 * @link https://bel-cms.be
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2014-2019 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
if (isset($_SESSION['LOGIN_MANAGEMENT']) && $_SESSION['LOGIN_MANAGEMENT'] === true):
?>
<form action="/groups/sendedit?management&parameter=true" method="post" class="form-horizontal">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title"><?=GROUPS?></h3>
		</div>
		<div class="card-body">
			<div class="form-group">
				<label for="input-Default" class="col-sm-2 control-label"><?=NAME?></label>
				<div class="col-sm-10">
					<input name="name" type="text" class="form-control" id="input-Default" value="<?=$data->name?>">
				</div>
			</div>
		</div>
		<div class="card-footer">
			<input type="hidden" name="id" value="<?=$data->id_group?>">
			<button type="submit" class="btn btn-primary"><?=EDIT?></button>
		</div>
	</div>
</form>
<?php
endif;