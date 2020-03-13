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
<div class="x_panel">
	<div class="x_title">
		<h2>Menu Page téléchargements</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<a href="/Blog?management&page=true" class="btn btn-app">
			<i class="fa fas fa-home"></i> Accueil
		</a>
		<a href="Blog/parameter?management&page=true" class="btn btn-app">
			<i class="fa fas fa-cogs"></i> Configuration
		</a>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-white">
		<div class="panel-heading clearfix">
			<h4 class="panel-title"><?=BLOG?></h4>
		</div>
		<div class="panel-body basic-form-panel">
			<form action="/downloads/sendadd?management&page=true" enctype="multipart/form-data" method="post" class="form-horizontal">
				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label"><?=NAME?></label>
					<div class="col-sm-10">
						<input name="name" type="text" class="form-control" id="input-Default" required="required">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?=TEXT?></label>
					<div class="col-sm-10">
						<textarea class="bel_cms_textarea_full" name="description"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?=CATEGORY?></label>
					<div class="col-sm-10">
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
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Fichier (<?=Common::ConvertSize(Common::GetMaximumFileUploadSize())?> max)</label>
					<div class="col-sm-10">
						<input name="download" type="file" class="form-control" required="required">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Image</label>
					<div class="col-sm-10">
						<input name="screen" type="file" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary"><?=ADD?></button>
				</div>
			</form>
		</div>
	</div>
</div>