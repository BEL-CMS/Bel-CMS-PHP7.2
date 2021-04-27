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
<form action="/page/sendparameter?management&page=true" method="post" class="form-horizontal">

<div class="x_panel">
	<div class="x_title">
		<h2>Menu Page</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<a href="/Page?management&page=true" class="btn btn-app">
			<i class="fa fas fa-home"></i> Accueil
		</a>
		<a href="Page/parameter?management&page=true" class="btn btn-app">
			<i class="fa fas fa-cogs"></i> Configuration
		</a>
		<button type="submit" class="btn btn-app">
			<i class="fa fa-save"></i> <?=SAVE?>
		</button>
	</div>
</div>


<div class="col-md-12">
	<div class="panel panel-white">
		<div class="panel-body">
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
		</div>
	</div>
</div>
</form>
<?php
endif;
