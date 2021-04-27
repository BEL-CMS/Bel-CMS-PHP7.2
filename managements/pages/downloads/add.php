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
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="card">
			<div class="card-header">
				<div class="card-title"><?=DOWNLOADS?> - Catégories - Edition</div>
			</div>
			<div class="card_body">
				<form action="/downloads/sendadd?management&page=true" enctype="multipart/form-data" method="post" class="form-horizontal">
					<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0"><?=NAME?></div>
					<div class="card-body">
						<input name="name" type="text" class="form-control" id="input-Default" required="required">
					</div>
					<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0"><?=TEXT?></div>
					<div class="card-body">
						<textarea class="ckeditor" name="description"></textarea>
					</div>
					<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0"><?=CATEGORY?></div>
					<div class="card-body">
						<select name="idcat" class="select2_single form-control">
						<?php
						foreach ($cat as $a => $b):
							?>
							<option value="<?=$b->id?>"><?=$b->name?></option>
							<?php
						endforeach;
						?>
						</select>
					</div>
					<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0">Fichier (<?=Common::ConvertSize(Common::GetMaximumFileUploadSize())?> max)</div>
					<div class="card-body">
						<div class="col-sm-10">
							<input name="download" type="file" class="form-control" required="required">
						</div>
					</div>
					<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0">Image</div>
					<div class="card-body">
							<input name="screen" type="file" class="form-control">
					</div>
					<div class="card-footer">
						<button type="submit" class="btn btn-primary"><?=ADD?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>