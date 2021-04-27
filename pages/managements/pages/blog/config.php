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
if (Secures::getAccessPageGroups()) {
	?>
<form action="/blog/sendparameter?management&page=true" method="post">
	<div class="row">
		<div class="col-lg-4 col-md-12 col-sm-12">
			<div class="card">
				<div class="list-group list-group-transparent mb-0 mail-inbox">
					<div class="mt-4 mb-4 ml-4 mr-4 text-center">
						<button type="submit" class="btn btn-success btn-lg btn-block"><?=SAVE?></button>
					</div>
					<a href="/blog?management&page=true" class="list-group-item list-group-item-action d-flex align-items-center active">
						<span class="icon mr-3"><i class="fa fas fa-home"></i></span><?=HOME?>
					</a>
					<a href="/Blog/parameter?management&page=true" class="list-group-item list-group-item-action d-flex align-items-center">
						<span class="icon mr-3"><i class="fa fas fa-cogs"></i></span><?=CONFIG?>
					</a>
				</div>
			</div>
		</div>
		<div class="col-lg-8 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Paramètre du blog</h3>
				</div>
				<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0">Page Actif</div>
				<div class="card-body">
					<div class="form-group">
						<label class="custom-switch">
							<input value="1" type="checkbox" class="custom-switch-input" <?=$config->active == 1 ? 'checked' : ''?> name="active">
							<span class="custom-switch-indicator"></span>
							<span class="custom-switch-description">Actif</span>
						</label>
					</div>
				</div>
				<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0">Accès aux Administrateurs</div>
				<div class="card-body">
					<div class="form-group">
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
				<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0">Accès aux groupes</div>
				<div class="card-body">
					<div class="form-group">
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
				<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0"><?=NB_BLOG?></div>
				<div class="card-body">
					<div class="form-group">
						<input id="input-NB_BLOG" name="MAX_BLOG" type="number" class="form-control" type="number" value="<?=$config->config['MAX_BLOG']?>" min="1" max="16">
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
	<?php
}