<div class="col-md-12">
	<div class="panel panel-white">
		<div class="panel-heading clearfix">
			<h4 class="panel-title"><?=FORUM?></h4>
		</div>
		<div class="panel-body basic-form-panel">
			<form action="/Forum/send?management&page=true" method="post" class="form-horizontal">

				<div class="form-group">
					<label for="label_title" class="col-sm-2 control-label"><?=TITLE?></label>
					<div class="col-sm-10">
						<input name="title" class="form-control" id="label_title" type="text" required="required" placeholder="Titre du forum">
					</div>
				</div>

				<div class="form-group">
					<label for="label_subtitle" class="col-sm-2 control-label"><?=SUBTITLE?></label>
					<div class="col-sm-10">
						<input name="subtitle" class="form-control" id="label_subtitle" type="text" required="required" placeholder="Sous-titre du forum">
					</div>
				</div>

				<div class="form-group">
					<label for="label_orderby" class="col-sm-2 control-label"><?=ORDER?></label>
					<div class="col-sm-10">
						<input name="orderby" class="form-control" id="label_orderby" type="number" required="required" placeholder="1" min="1">
					</div>
				</div>

				<div class="form-group">
					<label for="label_icon" class="col-sm-2 control-label"><?=VIEW?> <a target="_blank" href="https://fontawesome.com/icons?d=gallery&m=free"><?=ICON?></a></label>
					<div class="col-sm-10">
						<input name="icon" class="form-control" id="label_icon" type="text" placeholder="fa fa-code">
					</div>
				</div>

				<div class="form-group">
					<label for="label_orderby" class="col-sm-2 control-label"><?=CATEGORY?></label>
					<div class="col-sm-10">
						<select required="required" name="id_forum" class="form-control">
							<?php
							foreach ($data as $v):
								echo '<option value="'.$v->id.'">'.$v->title.'</option>';
							endforeach;
							?>
						</select>
					</div>
				</div>

				<div class="form-actions">
					<input type="hidden" name="send" value="addforum">
					<button type="submit" class="btn btn-primary"><?=ADD?></button>
				</div>
			</form>
		</div>
	</div>
</div>