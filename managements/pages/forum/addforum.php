<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="block full">
		    <div class="block-title">
		        <h2><strong>Menu page</strong> forum</h2>
		    </div>
			<div class="table-responsive">
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
					</div>
					<div class="form-group form-actions">
						<div class="col-sm-9 col-sm-offset-3">
							<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=SAVE?></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>