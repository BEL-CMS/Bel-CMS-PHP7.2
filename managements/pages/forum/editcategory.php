<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="block full">
		    <div class="block-title">
		        <h2><strong>Edit page</strong> forum</h2>
		    </div>
			<div class="table-responsive">
			<form action="/Forum/send?management&page=true" method="post" class="form-horizontal">
				<div class="form-group">
					<label for="input-title" class="col-sm-3 control-label"><?=TITLE?></label>
					<div class="col-sm-9">
						<input name="title" placeholder="Titre de la catégorie" type="text" class="form-control" id="input-title" value="<?=$data->title?>" required="required">
					</div>
				</div>
				<div class="form-group">
					<label for="input-subtitle" class="col-sm-3 control-label"><?=SUBTITLE?></label>
					<div class="col-sm-9">
						<input name="subtitle" placeholder="Sous-titre de la catégorie" type="text" class="form-control" id="input-subtitle" value="<?=$data->subtitle?>"">
					</div>
				</div>
				<div class="form-group">
					<label for="input-orderby" class="col-sm-3 control-label"><?=ORDER?></label>
					<div class="col-sm-9">
						<input name="orderby" placeholder="1" min="1" type="number" class="form-control" id="input-orderby" value="<?=$data->orderby?>"">
					</div>
				</div>
				<?php
				if ($data->activate == 1) {
					$checked = 'checked';
				} else {
					$checked = null;
				}
				?>
				<div class="form-group">
					<label for="label_icon" class="col-sm-3 control-label"><?=ACTIVE?></label>
					<div class="col-sm-9">
						<label>
							<input value="1" type="checkbox" class="js-switch" name="activate" <?=$checked?>> <?=ACTIVATE?>
						</label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Accès aux Administrateurs</label>
					<div class="col-sm-9">
						<?php
						foreach ($groups as $k => $v):
							if (in_array($v, $data->access_admin)) {
								$checked = 'checked';
							} else {
								$checked = null;
							}
							if ($v == 1) {
								$checked = 'checked';
							}
							?>
							<div class="input-group">
								<span class="input-group-addon">
									<input name="access_admin[]" value="<?=$v?>" type="checkbox" <?=$checked?>>
								</span>
								<input type="text" class="form-control" disabled="disabled" value="<?=$k?>">
							</div>
							<?php
						endforeach;
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?=NAME?></label>
					<div class="col-sm-9">
						<?php
						$visitor = constant('VISITORS');
						//$groups->$visitor = 0;
						foreach ($groups as $k => $v):
							if (in_array($v, $data->access_groups)) {
								$checked = 'checked';
							} else {
								$checked = null;
							}
							if ($v == 1) {
								$checked = 'checked';
							}
							?>
							<div class="input-group">
								<span class="input-group-addon">
									<input name="access_groups[]" value="<?=$v?>" type="checkbox" <?=$checked?>>
								</span>
								<input type="text" class="form-control" disabled="disabled" value="<?=$k?>">
							</div>
							<?php
						endforeach;
						if (in_array(0, $data->access_groups)) {
							$checked = 'checked';
						} else {
							$checked = null;
						}
						?>
							<div class="input-group">
								<span class="input-group-addon">
									<input <?=$checked?> name="access_groups[]" value="0" type="checkbox">
								</span>
								<input type="text" class="form-control" disabled="disabled" value="<?=$visitor?>">
							</div>
					</div>
				</div>
				<div class="form-group form-actions">
					<div class="col-sm-9 col-sm-offset-3">
						<input type="hidden" name="id" value="<?=$data->id?>">
						<input type="hidden" name="send" value="editcat">
						<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=SAVE?></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>