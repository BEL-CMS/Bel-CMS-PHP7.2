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
<div class="col-md-3">
	<div class="panel panel-white">
		<div class="panel-body">
			<button onclick="window.location.href='/shoutbox/deleteall?management&widgets=true'" class="email-compose-button btn btn-danger btn-block">Supprimer tout</button>
			<ul class="list-unstyled mailbox-nav">
				<li><a href="/shoutbox?management&widgets=true"><i class="fas fa-home"></i>Accueil</a></li>
				<li class="active"><a href="/shoutbox/parameter?management&widgets=true"><i class="fas fa-cogs"></i>Configuration</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="col-md-9">
	<div class="panel panel-white">
		<div class="panel-body">
			<form action="/shoutbox/sendparameter?management&widgets=true" method="post" class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-2 control-label">Page Activer</label>
					<div class="col-sm-10">
						<div class="checkbox">
							<input value="1" name="active" type="checkbox" <?=$config->active == 1 ? 'checked' : ''?>>Activer
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
						<input name="JS" value="1" type="checkbox" <?=$chkjs?> > Activer
					</div>
				</div>
				<div class="form-group">
					<label for="input-CSS" class="col-sm-2 control-label"><?=CSS?></label>
					<div class="col-sm-10">
						<?php $chkcss = $config->config['CSS'] == 1 ? 'checked' : ''; ?>
						<input name="CSS" value="1" type="checkbox" <?=$chkcss?> > Activer
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
				<button type="submit" class="btn btn-primary"><?=SAVE?></button>
			</form>
		</div>
	</div>
</div>
<?php
endif;
