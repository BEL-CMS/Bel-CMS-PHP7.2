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
	<div class="col-lg-12">
		<form action="prefgen/send?management&parameter=true" method="post" class="form-horizontal">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><?=MANAGEMENT_TITLE_NAME?></h3>
				</div>
				<div class="card-body">
					<?=$form?>
				</div>
			</div>
			<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=SAVE?></button>
		</form>
	</div>
</div>
<?php
endif;