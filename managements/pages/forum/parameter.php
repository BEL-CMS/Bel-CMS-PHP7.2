<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
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
if (isset($_SESSION['LOGIN_MANAGEMENT']) && $_SESSION['LOGIN_MANAGEMENT'] === true):
?>
<form action="/Forum/sendparameter?management&page=true" method="post" class="form-horizontal">
	<div class="row">
		<div class="col-md-2">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Forum : Câtégorie</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
							<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<div class="form-group">
						<div class="icheck-primary d-inline"></div>
						<input data-bootstrap-switch value="1" type="checkbox" <?=$config->active == 1 ? 'checked' : ''?> name="active">
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="input-NB_BLOG" class="col-sm-12 control-label"><?=NB_MSG_FORUM?></label>
					<div class="col-sm-12">
						<input id="input-NB_BLOG" name="NB_MSG_FORUM" type="number" class="form-control" type="number" value="<?=$config->config['NB_MSG_FORUM']?>" min="1" max="16">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Accès aux Administrateurs</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
							<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<?php
					foreach ($groups as $k => $v):
						$checked = in_array($v['id'], $config->access_admin) ? 'checked' : '';
						$checked = $v['id'] == 1 ? 'checked readonly' : $checked;
					?>
					<div class="form-group">
						<div class="icheck-primary d-inline">
							<input class="col-4" data-bootstrap-switch id="<?=$v['id']?>" name="admin[]" value="<?=$v['id']?>" type="checkbox" style="vertical-align: -moz-middle-with-baseline;" <?=$checked?>>
							<label class="col-8 control-label" for="<?=$v['id']?>"><?=$k?></label>
						</div>
					</div>
					<?php
					endforeach;
					?>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Accès aux groupes</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
							<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
				<?php
				$visitor = constant('VISITORS');
				$groups->$visitor = 0;
				foreach ($groups as $k => $v):
					$checked = in_array($v, $config->access_admin) ? 'checked' : '';
					$checked = $v['id'] == 1 ? 'checked readonly' : $checked;
					?>
					<div class="form-group">
						<div class="icheck-primary d-inline">
							<input class="col-8" data-bootstrap-switch name="admin[]" value="<?=$v['id']?>" type="checkbox" <?=$checked?>>
							<label class="col-4 control-label" for="<?=$v['id']?>"><?=$k?></label>
						</div>
					</div>
					<?php
				endforeach;
				?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group form-actions">
			<div class="col-sm-12 col-sm-offset-3">
				<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=SAVE?></button>
			</div>
		</div>	
	</div>
</form>
<?php
endif;
