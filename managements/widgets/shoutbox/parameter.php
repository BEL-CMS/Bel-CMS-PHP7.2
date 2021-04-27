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
	<div class="col-lg-12 col-md-12 col-sm-12">
        <div class="block">
            <div class="block-title">
                <h2>Paramètres Shoutbox</h2>
            </div>
			<form action="/shoutbox/sendparameter?management&widgets=true" method="post" class="form-horizontal form-bordered">
				<div class="form-group">
					<label class="col-sm-2 control-label">Page Activer</label>
					<div class="col-sm-10">
						<div class="checkbox">
							<label>
								<input type="checkbox" class="js-switch" <?=$config->active == 1 ? 'checked' : ''?> name="active"> Activer
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Nom personnalisé du widgets</label>
					<div class="col-sm-10">
						<div class="checkbox">
							<input class="form-control" name="title" type="text" value="<?=$config->title?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Accès aux Administrateurs</label>
					<div class="col-sm-10">
						<?php
						foreach ($groups as $k => $v):
							$checked = in_array($v, $config->groups_admin) ? 'checked' : '';
							$checked = $v == 1 ? 'checked' : $checked;
							?>
							<div class="input-group">
								<span class="input-group-addon">
									<input name="admin[]" value="<?=$v?>" type="checkbox" <?=$checked?>>
								</span>
								<input type="text" class="form-control" disabled="disabled" value="<?=$k?>">
							</div>
							<?php
						endforeach;
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Accès aux groupes</label>
					<div class="col-sm-10">
						<?php
						$visitor = constant('VISITORS');
						$groups->$visitor = 0;
						foreach ($groups as $k => $v):
							$checked = in_array($v, $config->groups_access) ? 'checked' : '';
							$checked = $v == 1 ? 'checked' : $checked;
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
				<div class="form-group">
					<label for="input-NB_MSG" class="col-sm-2 control-label"><?=NB_MSG?></label>
					<div class="col-sm-10">
						<input id="input-NB_MSG" name="MAX_MSG" type="number" class="form-control" type="number" value="<?=$config->config['MAX_MSG']?>" min="5" max="25">
					</div>
				</div>
				<div class="form-group">
					<label for="input-JS" class="col-sm-2 control-label"><?=JS?></label>
					<div class="col-sm-10">
						<?php $chkjs = $config->config['JS'] == 1 ? 'checked' : ''; ?>
						<label>
							<input value="1" type="checkbox" class="js-switch" <?=$chkjs?> name="JS"> Activer
						</label>
					</div>
				</div>
				<div class="form-group">
					<label for="input-CSS" class="col-sm-2 control-label"><?=CSS?></label>
					<div class="col-sm-10">
						<?php $chkcss = $config->config['CSS'] == 1 ? 'checked' : ''; ?>
						<label>
							<input value="1" type="checkbox" class="js-switch" <?=$chkcss?> name="CSS"> Activer
						</label>
					</div>
				</div>
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
					<label class="col-sm-2 control-label">Disposition</label>
					<div class="col-sm-10">
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
				<div class="form-group">
					<label class="col-sm-2 control-label">Pages à afficher</label>
					<div class="col-sm-10">
						<?php
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
