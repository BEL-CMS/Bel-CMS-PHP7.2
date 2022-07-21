<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2022 Bel-CMS
 * @author Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
?>
<form action="/color/sendadd?management&templates=true" method="post" class="form-horizontal">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title"><?=COLORS?></h3>
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
					<i class="fas fa-minus"></i>
				</button>
			</div>
		</div>
		<div class="card-body">
			<div class="form-group">
				<label class="col-sm-12 control-label" for="input-top">Couleur Haut (Titre)</label>
				<div class="col-sm-12">
					<input name="COLOR_TOP" type="text" class="form-control form-control-border colorpicker" id="input-top" required="required" value="<?=COLOR_TOP;?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label" for="input-body">Couleur du corp de la page (contenue)</label>
				<div class="col-sm-12">
					<input name="COLOR_BODY" type="text" class="form-control form-control-border colorpicker" id="input-body" required="required" value="<?=COLOR_BODY;?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label" for="input-bottom">Couleur footer (bas)</label>
				<div class="col-sm-12">
					<input name="COLOR_BOTTOM" type="text" class="form-control form-control-border colorpicker " id="input-bottom" required="required" value="<?=COLOR_BOTTOM;?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label" for="input-text">Couleur du texte</label>
				<div class="col-sm-12">
					<input name="COLOR_TEXT" type="text" class="form-control form-control-border colorpicker" id="input-text" required="required" value="<?=COLOR_TEXT;?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label" for="input-link">Couleur des liens</label>
				<div class="col-sm-12">
					<input name="COLOR_LINK" type="text" class="form-control form-control-border colorpicker" id="input-link" required="required" value="<?=COLOR_LINK;?>">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<label class="col-sm-12 control-label" for="input-table">Choix du type de tableau</label>
					<select name="TYPE_TABLE" class="form-select col-sm-12">
						<option value="<?=TYPE_TABLE;?>"><?=TYPE_TABLE;?></option>
						<option value="table-striped">table-striped</option>
						<option value="table-dark table-striped">table-dark table-striped</option>
						<option value="table-striped table-hover">table-striped table-hover</option>
						<option value="table-hover">table-hover</option>
						<option value="table-dark table-hover">table-dark table-hover</option>
					</select>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary"><?=EDIT?></button>
		</div>
	</div>
</form>