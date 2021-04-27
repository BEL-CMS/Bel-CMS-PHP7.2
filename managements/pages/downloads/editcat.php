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
				<form action="/downloads/sendeditcat?management&page=true" method="post" class="form-horizontal">
					<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0"><?=NAME?></div>
					<div class="card-body">
						<input name="name" type="text" class="form-control" required="required" value="<?=$data->name?>">
					</div>
					<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0"><?=TEXT?></div>
					<div class="card-body">
						<textarea class="ckeditor" name="description"><?=$data->description?></textarea>
					</div>
					<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0">Accès aux groupes</div>
					<div class="card-body">
						<div class="col-sm-12">
							<?php
							$visitor = constant('VISITORS');
							$groups->$visitor = 0;
							$ex = explode('|', $data->groups);
							foreach ($groups as $k => $v):
								$checked = in_array($v, $ex) ? 'checked="checked"' : '';
								?>
								<div class="input-group">
									<span class="input-group-addon">
										<input name="groups[]" value="<?=$v?>" type="checkbox" <?=$checked?>>
									</span>
									<input type="text" class="form-control" disabled="disabled" value="<?=$k?>">
								</div>
								<?php
							endforeach;
							?>
						</div>
					</div>
					<div class="card-footer">
						<input type="hidden" name="id" value="<?=$data->id?>">
						<button type="submit" class="btn btn-primary"><?=EDIT?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>