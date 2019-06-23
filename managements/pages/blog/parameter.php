<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.3
 * @link http://www.bel-cms.be
 * @link http://www.stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2016 Bel-CMS
 * @author Stive - mail@stive.eu
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
			<button class="email-compose-button btn btn-info btn-block" data-toggle="modal" data-target="#compose">Composer</button>
				<ul class="list-unstyled mailbox-nav">
					<li><a href="/Blog?management&page=true"><i class="fas fa-home"></i>Accueil</a></li>
					<li><a href="/Blog/parameter?management&page=true"><i class="fa fa-user-plus"></i><?=ADD?></a></li>
					<li class="active"><a href="/Blog/parameter?management&page=true"><i class="fas fa-cogs"></i>Configuration</a></li>
				</ul>
		</div>
	</div>
</div>
<div class="col-md-9">
	<div class="panel panel-white">
		<div class="panel-body">
			<form action="/blog/sendparameter?management&page=true" method="post" class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-2 control-label">Page Activer</label>
					<div class="col-sm-10">
						<div class="checkbox">
							<input value="1" name="active" type="checkbox" <?=$config->active == 1 ? 'checked' : ''?>>Activer
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Accès aux Administrateurs</label>
					<div class="col-sm-10">
						<?php
						foreach ($groups as $k => $v):
							$checked = in_array($v, $config->access_admin) ? 'checked' : '';
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
							$checked = in_array($v, $config->access_groups) ? 'checked' : '';
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
					<label for="input-NB_BLOG" class="col-sm-2 control-label"><?=NB_BLOG?></label>
					<div class="col-sm-10">
						<input id="input-NB_BLOG" name="MAX_BLOG" type="number" class="form-control" type="number" value="<?=$config->config['MAX_BLOG']?>" min="1" max="16">
					</div>
				</div>
				<button type="submit" class="btn btn-primary"><?=SAVE?></button>
			</form>
		</div>
	</div>
</div>
<?php
endif;
