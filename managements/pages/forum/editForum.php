<?php
debug($thread);
?>
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
						<input value="<?=$thread->title?>" name="title" class="form-control" id="label_title" type="text" required="required" placeholder="Titre du forum">
					</div>
				</div>

				<div class="form-group">
					<label for="label_subtitle" class="col-sm-2 control-label"><?=SUBTITLE?></label>
					<div class="col-sm-10">
						<input value="<?=$thread->subtitle?>" name="subtitle" class="form-control" id="label_subtitle" type="text" required="required" placeholder="Sous-titre du forum">
					</div>
				</div>

				<div class="form-group">
					<label for="lock" class="col-sm-2 control-label">Forum fermer</label>
					<div class="col-sm-10">
						<div class="checkbox">
							<?php
							$checked = $thread->options['lock'] == 0 ? '' : 'checked="checked"';
							?>
							<input id="lock" <?=$checked?> value="1" name="lock" type="checkbox">
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="label_orderby" class="col-sm-2 control-label"><?=ORDER?></label>
					<div class="col-sm-10">
						<input value="<?=$thread->orderby?>" name="orderby" class="form-control" id="label_orderby" type="number" required="required" placeholder="1" min="1">
					</div>
				</div>

				<div class="form-group">
					<label for="label_icon" class="col-sm-2 control-label"><?=VIEW?> (<a target="_blank" href="https://fontawesome.com/icons?d=gallery&m=free"><?=ICON?></a>)</label>
					<div class="col-sm-10">
						<input value="<?=$thread->icon?>" name="icon" class="form-control" id="label_icon" type="text" placeholder="fa fa-code">
					</div>
				</div>

				<div class="form-group">
					<label for="label_orderby" class="col-sm-2 control-label"><?=CATEGORY?></label>
					<div class="col-sm-10">
						<select required="required" name="id_forum" class="form-control">
							<?php
							foreach ($data as $v):
								if (isset($thread->id_forum->title)) {
									if ($v->title == $thread->id_forum->title) {
										$select = 'selected="selected"';
									} else {
										$select = null;
									}
								} else {
									$select = null;
								}
								echo '<option '.$select.' value="'.$v->id.'">'.$v->title.'</option>';
							endforeach;
							?>
						</select>
					</div>
				</div>

				<div class="form-actions">
					<input type="hidden" name="id" value="<?=$thread->id?>">
					<input type="hidden" name="send" value="editforum">
					<button type="submit" class="btn btn-primary"><?=ADD?></button>
				</div>
			</form>
		</div>
	</div>
</div>