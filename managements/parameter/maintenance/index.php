<?php
if ($data['status'] == 'open') {
	$ckd = 'checked="checked"';
} else {
	$ckd = '';
}
?>
<div class="row">
	<div class="col-lg-3">
		<form action="maintenance/sendpostOpen?management&parameter=true" method="post" class="form-horizontal form-label-left">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Statut du site</h3>
				</div>
				<div class="card-body">
					<label class="custom-switch">
						<input value="open" type="checkbox" name="close" class="custom-switch-input" <?=$ckd?>>
						<span class="custom-switch-indicator"></span>
						<span class="custom-switch-description">Ouvert</span>
					</label>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-primary"><?=SEND?></button>
				</div>
			</div>
		</form>
	</div>

	<div class="col-md-9 col-xs-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Message de fermeture</h3>
				</div>
				<div class="card-body">
					<form action="/maintenance/sendpost?management&parameter=true" method="post" class="form-horizontal form-label-left">

						<div class="form-group">
							<label class="control-label col-md-12">Titre</label>
							<div class="col-md-12">
								<input type="text" name="title" class="form-control" value="<?=$data['title']?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-12">Description</label>
							<div class="col-md-12">
								<textarea name="description" class="form-control" rows="3" placeholder=''><?=$data['description']?></textarea>
							</div>
						</div>

						<div class="card-footer">
							<button type="submit" class="btn btn-primary"><?=SEND?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>