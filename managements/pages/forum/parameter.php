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
		<div class="block full">
		    <div class="block-title">
		        <h2><strong>Menu page</strong> forum</h2>
		    </div>
			<div class="table-responsive">
			<!-- fin des boutton action -->				
				<form action="/Forum/sendparameter?management&page=true" method="post" class="form-horizontal">
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
								<div class="form-group">
									<label for="input-NB_BLOG" class="col-sm-2 control-label"><?=NB_MSG_FORUM?></label>
									<div class="col-sm-10">
										<input id="input-NB_BLOG" name="NB_MSG_FORUM" type="number" class="form-control" type="number" value="<?=$config->config['NB_MSG_FORUM']?>" min="1" max="16">
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
			</div>
		</div>
	</div>
</div>
<?php
endif;
