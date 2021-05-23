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
                <h2>Nom du nouveau groupe</h2>
            </div>
			<form action="/groups/sendnew?management&parameter=true" method="post" class="form-horizontal form-label-left">
				<div class="form-group">
					 <label class="col-md-2 control-label" for="colr">Entrer le nom du groupe</label>
					 <div class="col-md-10">
						<input type="text" name="name" class="form-control" placeholder="Entrer le nom du groupe">
					</div>
				</div>
				<div class="form-group">
				    <label class="col-md-2 control-label" for="colr">Couleur du groupe</label>
				    <div class="col-md-10">
				        <div class="input-group input-colorpicker">
				            <input type="text" id="example-colorpicker2" name="color" class="form-control" value="">
				            <span class="input-group-addon"><i></i></span>
				        </div>
				    </div>
				</div>
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