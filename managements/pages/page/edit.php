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
?>
<div class="x_panel">
	<div class="x_title">
		<h2>Menu Page Blog</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<a href="/page?management&page=true" class="btn btn-app">
			<i class="fa fas fa-home"></i> Accueil
		</a>
		<a href="page/parameter?management&page=true" class="btn btn-app">
			<i class="fa fas fa-cogs"></i> Configuration
		</a>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-white">
		<div class="panel-body basic-form-panel">
			<form action="/page/sendedit?management&page=true" method="post" class="form-horizontal">
				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label"><?=NAME?></label>
					<div class="col-sm-10">
						<input name="name" type="text" class="form-control" id="input-Default" value="<?=$data->name?>">
						<small>Doit-être unique</small>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?=TEXT?></label>
					<div class="col-sm-10">
						<textarea class="bel_cms_textarea_full" name="content"><?=$data->content?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Accès aux groupes</label>
					<div class="col-sm-10">
						<?php
						$visitor = constant('VISITORS');
						$groups->$visitor = 0;
						$ex = explode('|', $data->groups);
						foreach ($groups as $k => $v):
							$checked = in_array($v, $ex) ? 'checked="checked"' : '';
							$checked = $v == 1 ? "checked" : $checked;
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
					<input type="hidden" name="id" value="<?=$data->id?>">
					<button type="submit" class="btn btn-primary"><?=ADD?></button>
				</div>
			</form>
		</div>
	</div>
</div>