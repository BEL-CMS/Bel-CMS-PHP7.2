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
?>
<form action="/Forum/send?management&pages" method="post">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Ajouter une Catégories</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
							<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label for="input-title" class="control-label"><?=TITLE?></label>
						<input name="title" placeholder="Titre de la catégorie" type="text" class="form-control" id="input-title" required="required">
					</div>
					<div class="form-group">
						<label for="input-subtitle" class="control-label"><?=SUBTITLE?></label>
						<input name="subtitle" placeholder="Sous-titre de la catégorie" type="text" class="form-control" id="input-subtitle">
					</div>
					<div class="form-group">
						<label for="input-orderby" class="control-label"><?=ORDER?></label>
						<input name="orderby" placeholder="1" min="1" type="number" class="form-control" id="input-orderby">
					</div>
					<div class="form-group">
						<div class="icheck-primary d-inline"></div>
						<input data-bootstrap-switch value="1" type="checkbox" name="activate">
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
					<?php
					foreach ($groups as $k => $v):
						$checked = $v['id'] == 1 ? 'checked readonly' : '';
					?>
					<div class="form-group">
						<div class="icheck-primary d-inline">
							<input data-bootstrap-switch id="<?=$v['id']?>" name="access_admin[]" value="<?=$v['id']?>" type="checkbox" <?=$checked?>>
							<label class="control-label" for="<?=$v['id']?>"><?=$k?></label>
						</div>
					</div>
					<?php
					endforeach;
					?>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Accès aux groupes</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
							<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
				<?php
				$visitor = constant('VISITORS');
				$groups->$visitor = 0;
				foreach ($groups as $k => $v):
					$checked = $v['id'] == 1 ? 'checked readonly' : '';
					?>
					<div class="form-group">
						<div class="icheck-primary d-inline">
							<input data-bootstrap-switch name="access_groups[]" value="<?=$v['id']?>" type="checkbox" <?=$checked?>>
							<label control-label" for="<?=$v['id']?>"><?=$k?></label>
						</div>
					</div>
					<?php
				endforeach;
				?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group form-actions">
					<div class="col-sm-9 col-sm-offset-3">
						<input type="hidden" name="send" value="addcat">
						<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=SAVE?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>