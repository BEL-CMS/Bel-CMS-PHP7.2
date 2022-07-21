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
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Menu page</h3>
	</div>
	<div class="card-body">
		<form action="/page/sendnew?management&pages" method="post" class="form-horizontal">
			<div class="form-group">
				<label for="input-Default" class="col-sm-2 control-label"><?=NAME?></label>
				<div class="col-sm-10">
					<input name="name" type="text" class="form-control" id="input-Default" value="">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label">Accès aux groupes</label>
				<div class="col-sm-12">
				<?php
				$visitor = constant('VISITORS');
				$groups->$visitor = 0;
				foreach ($groups as $k => $v):
					$checked = $v['id'] == 1 ? 'checked readonly' : '';
					?>
					<div class="form-group">
						<div class="icheck-primary d-inline">
							<input class="col-sm-4" data-bootstrap-switch name="admin[]" value="<?=$v['id']?>" type="checkbox" <?=$checked?>>
							<label class="col-sm-8 control-label" for="<?=$v['id']?>"><?=$k?></label>
						</div>
					</div>
					<?php
				endforeach;
				?>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary"><?=ADD?></button>
			</div>
		</form>
	</div>
</div>