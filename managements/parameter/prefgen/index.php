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
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
        <div class="block">
            <div class="block-title">
                <h2>Paramètres Général</h2>
            </div>
			<form action="prefgen/send?management&parameter=true" method="post" class="form-horizontal form-bordered">
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
</div>
<?php
endif;