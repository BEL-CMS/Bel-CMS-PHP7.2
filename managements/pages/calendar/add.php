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
<form action="/calendar/sendadd?management&pages" enctype="multipart/form-data" method="post" class="form-horizontal">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Evénement</h3>
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
					<i class="fas fa-minus"></i>
				</button>
			</div>
		</div>
		<div class="card-body">
			<div class="form-group">
				<label class="col-sm-12 control-label padding-cell">Titre <span class="required">*</span></label>
				<div class="col-sm-12">
					<input type="text" name="name" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label padding-cell">Image</label>
				<div class="col-sm-12">
					<input type="file" name="image">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label padding-cell">date de début</label>
				<div class="col-sm-12">
					<div class="input-group">
						<input type="date" name="start_date" class="form-control" required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label padding-cell">Date de fin<span class="required">*²</span></label>
				<div class="col-sm-12">
					<div class="input-group">
						<input type="date" name="end_date" class="form-control">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label padding-cell">debût de l'événement</label>
				<div class="col-sm-12">
					<div class="input-group">
						<input type="time" name="start_time"  class="form-control">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label padding-cell">Fin de l'événement</label>
				<div class="col-sm-12">
					<div class="input-group">
						<input type="time" name="end_time" class="form-control">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label padding-cell">Couleur</label>
				<div class="col-sm-12">
					<input type="text" name="color" class="form-control colorpicker" required placeholder="#FFFFFF" pattern="#[0-9A-Fa-f]{6}]">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label padding-cell">Localisation</label>
				<div class="col-sm-12">
					<input type="text" name="location" class="form-control" value="">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label padding-cell">Description</label>
				<div class="col-sm-12">
					<textarea name="description" class="form-control" rows="5" id="textareaDefault"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label padding-cell"></label>
				<div class="col-sm-12 padding-cell">
					<button name="save" type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> <?=SAVE?></button>
					<a class="btn btn-default" href="/calendar?management&pages"><i class="fa fa-times"></i> Annulé</a>
				</div>
			</div>
		</div>
	</div>
</form>