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
	debug($data);
?>
<div class="col-md-12">
	<div class="panel panel-white">
		<div class="panel-body basic-form-panel">
			<form action="/newsletter/sendedittpl?management&page=true" method="post" class="form-horizontal">
				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label"><?=NAME?></label>
					<div class="col-sm-10">
						<input name="name" type="text" class="form-control" id="input-Default" required="required" value="<?=$data->name?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?=TEXT?></label>
					<div class="col-sm-10">
						<textarea class="bel_cms_textarea_full" name="template"><?=$data->template?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-2 control-label">Infos</div>
					<div class="col-sm-10">
						{user} , {date} , {website}, {name_website}
					</div>
				</div>		
				<div class="form-group">
					<input type="hidden" name="id" value="<?=$data->id?>">
					<button type="submit" class="btn btn-primary"><?=ADD?></button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
endif;