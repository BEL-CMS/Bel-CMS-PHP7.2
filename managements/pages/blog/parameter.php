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
                <h2>Paramètre du blog</h2>
            </div>
			<form action="/blog/sendparameter?management&page=true" method="post" class="form-horizontal form-bordered">
				<div class="form-group">
					<label class="col-sm-3 control-label" for="checkbox">Page Actif</label>
					<div class="col-sm-9">
						<input value="1" type="checkbox" id="checkbox" style="vertical-align: -moz-middle-with-baseline;" <?=$config->active == 1 ? 'checked' : ''?> name="active">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-9 col-sm-offset-3">Accès aux Administrateurs</div>
				</div>
				<?php
				foreach ($groups as $k => $v):
					$checked = in_array($v, $config->access_admin) ? 'checked' : '';
					$checked = $v == 1 ? 'checked' : $checked;
				?>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="<?=$v?>"><?=$k?></label>
					<div class="col-sm-9">
						<input id="<?=$v?>" name="admin[]" value="<?=$v?>" type="checkbox" style="vertical-align: -moz-middle-with-baseline;" <?=$checked?>>
					</div>
				</div>
				<?php
				endforeach;
				?>
				<div class="form-group">
					<div class="col-sm-9 col-sm-offset-3">Accès aux groupes</div>
				</div>
				<?php
				$visitor = constant('VISITORS');
				$groups->$visitor = 0;
				foreach ($groups as $k => $v):
					$checked = in_array($v, $config->access_admin) ? 'checked' : '';
					$checked = $v == 1 ? 'checked' : $checked;
					?>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="<?=$v?>"><?=$k?></label>
						<div class="col-sm-9">
							<input name="admin[]" value="<?=$v?>" type="checkbox" <?=$checked?>>
						</div>
					</div>
					<?php
				endforeach;
				?>
				<div class="form-group">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="<?=NB_BLOG?>"><?=NB_BLOG?></label>
						<div class="col-sm-9">
							<input id="input-NB_BLOG" name="MAX_BLOG" type="number" class="form-control" type="number" value="<?=$config->config['MAX_BLOG']?>" min="1" max="16">
						</div>
					</div>
				</div>
				<div class="form-group form-actions">
					<div class="col-sm-9 col-sm-offset-3">
						<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=SAVE?></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
endif;
