<form action="/Forum/send?management&page=true" method="post" class="form-horizontal">
<div class="x_panel">
	<div class="x_title">
		<h2>Menu Page Forum</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<a href="/Forum?management&page=true" class="btn btn-app">
			<i class="fa fas fa-home"></i> Accueil
		</a>
		<a href="Forum/parameter?management&page=true" class="btn btn-app">
			<i class="fa fas fa-cogs"></i> Configuration
		</a>
		<a href="/Forum/category?management&page=true" class="btn btn-app">
			<i class="fa far fa-plus-square"></i> <?=CATEGORY?>
		</a>
		<button type="submit" class="btn btn-app">
			<i class="fa fas fa-save"></i> <?=SAVE?>
		</button>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-white">
		<div class="panel-heading clearfix">
			<h4 class="panel-title"><?=FORUM?></h4>
		</div>
		<div class="panel-body basic-form-panel">

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
				</div>
		</div>
	</div>
</div>
</form>