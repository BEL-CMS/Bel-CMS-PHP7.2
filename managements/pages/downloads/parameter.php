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
                <h2>Paramètre du téléchargement</h2>
            </div>
			<form action="/downloads/sendparameter?management&page=true" method="post" class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-2 control-label">Page Activer</label>
					<div class="col-sm-10">
						<label>
							<input value="1" type="checkbox" class="js-switch" <?=$config->active == 1 ? 'checked' : ''?> name="active"> Activer
						</label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Accès aux Administrateurs</label>
					<div class="col-sm-10">
						<?php
						foreach ($groups as $k => $v):
							$checked = in_array($v['id'], $config->access_admin) ? 'checked' : '';
							$checked = $v['id'] == 1 ? 'checked' : $checked;
							?>
							<div class="input-group">
								<span class="input-group-addon">
									<input name="admin[]" value="<?=$v['id']?>" type="checkbox" <?=$checked?>>
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
							$checked = in_array($v['id'], $config->access_groups) ? 'checked' : '';
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
				<div class="card-footer">
					<button type="submit" class="btn btn-primary"><?=SAVE?></button>
				</div>
		</div>
	</div>
</div>
</form>
<?php
endif;
