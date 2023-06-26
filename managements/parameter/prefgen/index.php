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
if (isset($_SESSION['LOGIN_MANAGEMENT']) && $_SESSION['LOGIN_MANAGEMENT'] === true):
?>
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Paramètres Général Info</h3>
	</div>
	<div class="card-body">
		<form action="prefgen/send?users&parameter=true" method="post" class="form-horizontal form-bordered">
		<?php
		foreach ($form as $k => $v):
			$name  = (defined('ADMIN_'.$v->name)) ? constant('ADMIN_'.$v->name) : $v->name;
			if ($v->id == 8) {}else {
			?>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="<?=$v->id?>"><?=$name?></label>
				<div class="col-sm-9">
					<input value="<?=$v->value?>" type="text" id="<?=$v->id?>" name="<?=$v->id?>" class="form-control input-sm" placeholder="">
				</div>
			</div>
			<?php
			}
		endforeach;
		?>
			<div class="form-group form-actions">
				<div class="col-sm-9 col-sm-offset-3">
					<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=SAVE?></button>
				</div>
			</div>
		</form>
	</div>
</div>
<?php
endif;