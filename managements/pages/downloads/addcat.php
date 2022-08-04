<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
?>
<form action="/downloads/sendnewcat?management&pages" method="post" class="form-horizontal">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title"><?=DOWNLOADS?> - Catégories</h3>
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
					<input name="name" type="text" class="form-control" value="">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label" for="checkbox"><?=TEXT?></label>
				<div class="col-sm-12">
					<textarea class="bel_cms_textarea_full" name="description"></textarea>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="card-header">
				<h3 class="card-title">Accès aux groupes</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
						<i class="fas fa-minus"></i>
					</button>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="col-sm-12">
				<?php
				$visitor = constant('VISITORS');
				$groups->$visitor = 0;
				foreach ($groups as $k => $v):
				//$checked = in_array($v, $data->access_admin) ? 'checked' : '';
				$checked = $v['id'] == 1 ? 'checked readonly' : '';
				?>
				<div class="form-group">
					<div class="icheck-primary d-inline">
						<input <?=$checked;?> class="col-8" data-bootstrap-switch name="admin[]" value="<?=$v['id']?>" type="checkbox" >
						<label class="col-4 control-label" for="<?=$v['id']?>"><?=$k?></label>
					</div>
				</div>
				<?php
				endforeach;
				?>
			</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary"><?=SUBMIT?></button>
		</div>
	</div>
</form>