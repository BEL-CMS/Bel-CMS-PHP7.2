<div class="col-md-12">
	<div class="panel panel-white">
		<div class="panel-heading clearfix">
			<h4 class="panel-title"><?=FORUM?></h4>
		</div>
		<div class="panel-body basic-form-panel">
			<form action="/Forum/send?management&page=true" method="post" class="form-horizontal">
				<div class="form-group">
					<label for="input-title" class="col-sm-2 control-label"><?=TITLE?></label>
					<div class="col-sm-10">
						<input name="title" placeholder="Titre de la catégorie" type="text" class="form-control" id="input-title" equired="required">
					</div>
				</div>

				<div class="form-group">
					<label for="input-subtitle" class="col-sm-2 control-label"><?=SUBTITLE?></label>
					<div class="col-sm-10">
						<input name="subtitle" placeholder="Sous-titre de la catégorie" type="text" class="form-control" id="input-subtitle">
					</div>
				</div>

				<div class="form-group">
					<label for="input-orderby" class="col-sm-2 control-label"><?=ORDER?></label>
					<div class="col-sm-10">
						<input name="orderby" placeholder="1" min="1" type="number" class="form-control" id="input-orderby">
					</div>
				</div>


				<div class="form-group">
					<label for="label_icon" class="col-sm-2 control-label"><?=ACTIVE?></label>
					<div class="col-sm-10">
						<input checked="checked" name="activate" id="label_actif" value="1" type="radio"><?=ACTIVATE?>
						<input name="activate" id="label_actif" value="0" type="radio"><?=DISABLE?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Accès aux Administrateurs</label>
					<div class="col-sm-10">
						<?php
						foreach ($groups as $k => $v):
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
					<label class="col-sm-2 control-label">Accès aux groupes</label>
					<div class="col-sm-10">
						<?php
						$visitor = constant('VISITORS');
						//$groups->$visitor = 0;
						foreach ($groups as $k => $v):
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
						?>
							<div class="input-group">
								<span class="input-group-addon">
									<input name="access_groups[]" value="0" type="checkbox">
								</span>
								<input type="text" class="form-control" disabled="disabled" value="<?=$visitor?>">
							</div>
					</div>
				</div>



				<div class="form-actions">
					<input type="hidden" name="send" value="addcat">
					<button type="submit" class="btn btn-primary"><?=EDIT?></button>
				</div>
			</form>
		</div>
	</div>
</div>