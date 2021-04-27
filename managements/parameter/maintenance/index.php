<?php
if ($data['status'] == 'open') {
	$ckd = 'checked="checked"';
} else {
	$ckd = '';
}
?>
<div class="row">
	<div class="col-lg-12">
        <div class="block">
            <div class="block-title">
                <h2>Maintenance</h2>
            </div>
			<form action="maintenance/sendpostOpen?management&parameter=true" method="post" class="form-horizontal form-label-left bm-5">
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
					<div style="margin-bottom: 10px;">
						<button type="submit" class="btn btn-primary mb-5"><?=SEND?></button>
					</div>
				</div>
			</form>
		</div>
<div class="row">
	<div class="col-lg-12">
        <div class="block">
            <div class="block-title">
                <h2>Message de fermeture</h2>
            </div>
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

				<div style="margin-bottom: 10px;">
					<button type="submit" class="btn btn-primary mb-5"><?=SEND?></button>
				</div>
			</form>
		</div>
	</div>
</div>