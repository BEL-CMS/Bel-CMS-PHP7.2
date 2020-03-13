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
?>
<div class="x_panel">
	<div class="x_title">
		<h2>Menu Widgets Sondage</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<a href="survey?management&widgets=true" class="btn btn-app">
			<i class="fa fas fa-home"></i> Accueil
		</a>
	</div>
</div>
<form class="form-horizontal" action="/survey/send?management&widgets=true" method="post">
<div class="col-md-12">
	<div class="panel panel-white">
		<div class="panel-body">
			<div class="form-group mb-2">
				<label class="col-sm-2 control-label">Titre</label>
				<div class="col-sm-10">
					<input name="name" type="text" class="form-control">
				</div>
			</div>
			<div class="form-group mb-2">
				<label class="col-sm-2 control-label">Question 1</label>
				<div class="col-sm-10">
					<input name="quest[]" type="text" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Question 2</label>
				<div class="col-sm-10">
					<input name="quest[]" type="text" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Question 3</label>
				<div class="col-sm-10">
					<input name="quest[]" type="text" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Question 4</label>
				<div class="col-sm-10">
					<input name="quest[]" type="text" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Question 5</label>
				<div class="col-sm-10">
					<input name="quest[]" type="text" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Question 6</label>
				<div class="col-sm-10">
					<input name="quest[]" type="text" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Question 7</label>
				<div class="col-sm-10">
					<input name="quest[]" type="text" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Question 8</label>
				<div class="col-sm-10">
					<input name="quest[]" type="text" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Question 9</label>
				<div class="col-sm-10">
					<input name="quest[]" type="text" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Question 10</label>
				<div class="col-sm-10">
					<input name="quest[]" type="text" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary"><?=ADD?></button>
			</div>
		</div>
	</div>
</div>
</form>