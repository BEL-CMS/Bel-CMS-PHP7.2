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
<form action="/shoutbox/sendparameter?management&widgets=true" method="post" class="form-horizontal">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Paramètres Shoutbox</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
							<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<div class="form-group">
						<div class="icheck-primary d-inline"></div>
						<input data-bootstrap-switch value="1" type="checkbox" <?=$config->active == 1 ? 'checked' : ''?> name="active">
					</div>
					<div class="form-group">
						<label class="col-sm-12 control-label">Nom personnalisé du widgets</label>
						<div class="col-sm-12">
							<div class="checkbox">
								<input class="form-control" name="title" type="text" value="<?=$config->title?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="input-NB_MSG" class="col-sm-12 control-label"><?=NB_MSG?></label>
						<div class="col-sm-12">
							<input id="input-NB_MSG" name="MAX_MSG" type="number" class="form-control" type="number" value="<?=$config->config['MAX_MSG']?>" min="5" max="25">
						</div>
					</div>
					<div class="form-group">
						<label for="input-JS" class="col-sm-12 control-label"><?=JS?></label>
						<div class="col-sm-12">
							<?php $chkjs = $config->config['JS'] == 1 ? 'checked' : ''; ?>
							<label>
								<input value="1" type="checkbox" class="js-switch" <?=$chkjs?> name="JS"> Activer
							</label>
						</div>
					</div>
					<div class="form-group">
						<label for="input-CSS" class="col-sm-12 control-label"><?=CSS?></label>
						<div class="col-sm-12">
							<?php $chkcss = $config->config['CSS'] == 1 ? 'checked' : ''; ?>
							<label>
								<input value="1" type="checkbox" class="js-switch" <?=$chkcss?> name="CSS"> Activer
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-12 control-label">Pages à afficher</label>
						<div class="col-sm-12">
							<?php
							foreach ($pages as $key => $value) {
								if ($value == 'managements') {
									unset($pages[$key]);
								}
							}
							foreach ($pages as $k => $v):
								$checked = in_array($v, $config->pages) ? 'checked' : '';
								$checked = $v == 1 ? 'checked' : $checked;
								$name    = defined(strtoupper($v)) ? constant(strtoupper($v)) : $v;
								?>
								<div class="input-group">
									<span class="input-group-addon">
										<input name="pages[]" value="<?=$v?>" type="checkbox" <?=$checked?>>
									</span>
									<input type="text" class="form-control" disabled="disabled" value="<?=$name?>">
								</div>
								<?php
							endforeach;
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
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
					<div class="form-group">
						<div class="col-sm-12">
							<?php
							foreach ($groups as $k => $v):
									$checked = in_array($v, $config->groups_admin) ? 'checked' : '';
									$checked = $v['id'] == 1 ? 'checked' : $checked;
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
				<div class="form-group">
					<label class="col-sm-12 control-label">Accès aux groupes</label>
					<div class="col-sm-12">
						<?php
						$visitor = constant('VISITORS');
						$groups->$visitor = 0;
						foreach ($groups as $k => $v):
							$checked = in_array($v, $config->groups_access) ? 'checked' : '';
							$checked = $v['id'] == 1 ? 'checked' : $checked;
							?>
							<div class="input-group">
								<span class="input-group-addon">
									<input name="groups[]" value="<?=$v['id']?>" type="checkbox" <?=$checked?>>
								</span>
								<input type="text" class="form-control" disabled="disabled" value="<?=$k?>">
							</div>
							<?php
						endforeach;
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<?php
				$top = null; $right = null; $bottom = null; $left = null;
				if ($config->pos == "top") {
					$top = 'checked="checked"';
				} else if ($config->pos == "right") {
					$right = 'checked="checked"';
				} else if ($config->pos == "bottom") {
					$bottom = 'checked="checked"';
				} else if ($config->pos == "left") {
					$left = 'checked="checked"';
				}
				?>
				<div class="form-group">
					<label class="col-sm-12 control-label">Disposition</label>
					<div class="col-sm-12">
						<div class="input-group">
							<span class="input-group-addon">
								<input type="radio" name="pos" value="top" <?=$top?>>
							</span>
							<input type="text" class="form-control" disabled="disabled" value="Haut">
						</div>
						<div class="input-group">
							<span class="input-group-addon">
								<input type="radio" name="pos" value="right" <?=$right?>>
							</span>
							<input type="text" class="form-control" disabled="disabled" value="Droite">
						</div>
						<div class="input-group">
							<span class="input-group-addon">
								<input type="radio" name="pos" value="bottom" <?=$bottom?>>
							</span>
							<input type="text" class="form-control" disabled="disabled" value="Bas">
						</div>
						<div class="input-group">
							<span class="input-group-addon">
								<input type="radio" name="pos" value="left" <?=$left?>>
							</span>
							<input type="text" class="form-control" disabled="disabled" value="Gauche">
						</div>
					</div>
				</div>
				<div class="form-group form-actions">
					<div class="col-sm-9 col-sm-offset-3">
						<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=SAVE?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<?php
endif;
