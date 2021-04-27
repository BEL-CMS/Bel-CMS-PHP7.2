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
                    <h2>Entrer le nom du groupe</h2>
                </div>
				<form action="/groups/sendnew?management&parameter=true" method="post" class="form-horizontal">
					<div class="form-group">
						<div class="input-group">
							<input type="text" name="name" class="form-control" placeholder="Entrer le nom du groupe">
							<span class="input-group-append">
								<button class="btn btn-primary" type="submit"><?=SAVE?></button>
							</span>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
endif;