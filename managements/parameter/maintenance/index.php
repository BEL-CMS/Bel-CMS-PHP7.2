<?php
if ($data['status'] == 'open') {
	$ckd = 'checked="checked"';
} else {
	$ckd = '';
}
?>
<div class="row">
	<div class="col-md-3 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2><i class="glyphicon glyphicon-eye-close"></i>  Statut du site</h2>
				<div class="clearfix"></div>
			</div>
			<form  action="maintenance/sendpostOpen?management&parameter=true" method="post" class="form-horizontal form-label-left">
			<div class="x_content" style="text-align: center;">
				<input value="open" name="close" type="checkbox" class="js-switch" <?=$ckd?>>
			</div>
				<div class="form-group">
					<div>
						<button type="submit" class="btn btn-success">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="col-md-9 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<form action="/maintenance/sendpost?management&parameter=true" method="post" class="form-horizontal form-label-left">

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Titre</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title" class="form-control" value="Le site est temporairement inaccessible">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea name="description" class="form-control" rows="3" placeholder=''>Le site est temporairement inaccessible en raison d’activités de maintenance planifiées</textarea>
						</div>
					</div>

					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
							<button type="submit" class="btn btn-success">Submit</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>