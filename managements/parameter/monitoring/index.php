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
	<div class="col-lg-3 col-md-12 col-sm-12">
        <div class="block">
            <div class="block-title">
                <h2>Informations serveur</h2>
            </div>
            <form action="#" method="post" class="form-horizontal form-bordered">
				<div class="form-group">
					<label class="col-sm-3 control-label" for="">PHP Version</label>
					<div class="col-sm-9">
						<input value="<?=PHP_VERSION?>" type="text" id="" name="" class="form-control input-sm" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="">mySQLI</label>
					<div class="col-sm-9">
						<i style="color: green;" class="fa fa-check-circle-o"></i> Actif
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="">PDO</label>
					<div class="col-sm-9">
						<i style="color: green;" class="fa fa-check-circle-o"></i> Actif
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="">IntlDateFormatter</label>
					<div class="col-sm-9">
						<i style="color: green;" class="fa fa-check-circle-o"></i> Actif
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="">mod_rewrite</label>
					<div class="col-sm-9">
						<?PHP
						if (function_exists("apache_get_modules")) {
							$modules = apache_get_modules();
							$mod_rewrite = in_array("mod_rewrite",$modules);
						}
							$mod_rewrite = ($mod_rewrite == 1) ? '<i style="color: green;" class="fa fa-check-circle-o"></i> Actif' : '<i style="color: red;" class="fa fa-arrow-circle-down"></i>';
							echo $mod_rewrite;
						?>
					</div>
				</div>
					
	
			</form>
		</div>
	</div>
</div>
<?php
endif;