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
?>
<form action="/calendar/sendnewcat?management&pages" method="post" class="form-horizontal">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title"><?=GALLERY?> - Catégories</h3>
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
					<i class="fas fa-minus"></i>
				</button>
			</div>
		</div>
		<div class="card-body">
			<div class="form-group">
				<label class="col-sm-12 control-label" for="checkbox"><?=NAME?></label>
				<div class="col-sm-12">
					<input type="text" name="name" class="form-control" required minlength="5" maxlength="64">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label">Couleur</label>
				<div class="col-sm-12">
					<input type="text" placeholder="#FFFFFF" pattern="#[0-9A-Fa-f]{6}]" minlength="7" maxlength="7" name="color" class="form-control colorpicker" required>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary"><?=SUBMIT?></button>
			<a class="btn btn-default" href="/calendar?management&page=true"><i class="fa fa-times"></i> Annulé</a>
		</div>
	</div>
</form>