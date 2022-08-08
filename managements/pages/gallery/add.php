<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.1
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
?>
<form action="/gallery/sendadd?management&pages" enctype="multipart/form-data" method="post" class="form-horizontal">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Ajout d'une image</h3>
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
					<i class="fas fa-minus"></i>
				</button>
			</div>
		</div>
		<div class="card-body">
			<div class="form-group">
				<label class="col-sm-12 control-label" for="input-name"><?=NAME?></label>
				<div class="col-sm-12">
					<input name="name" type="text" class="form-control" id="input-name" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label" for="input-name">Description</label>
				<div class="col-sm-12">
					<input name="description" type="text" class="form-control" id="input-name" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label" for="input-name">Image (<?=Common::ConvertSize(Common::GetMaximumFileUploadSize())?> max)</label>
				<div class="col-sm-12">
					<input name="image" type="file" class="form-control">
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary"><?=ADD?></button>
			</div>
	</div>
</div>