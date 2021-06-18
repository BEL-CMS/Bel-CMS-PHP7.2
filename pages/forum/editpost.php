<form action="Forum/SendEditPost" method="post" enctype="multipart/form-data">
	<div class="card">
		<div class="card-header"><h3><i class="fa fa-comment"></i> <?=EDIT_REPLY?></h3></div>
		<div class="card-body">
			<textarea class="bel_cms_textarea_simple" name="info_text"><?=$d->content?></textarea>
			<div class="form-group">
				<label for="file_attachment"><?=FILE_ATTACHMENT?></label>
				<input type="file" name="file" class="form-control-file" id="file_attachment">
			</div>
		</div>
		<div class="card-footer">
			<input type="hidden" name="id" value="<?=$d->id;?>">
			<input type="hidden" name="id_post" value="<?=$d->id_post;?>">
			<input type="submit" value="<?=EDIT_POST?>" class="btn btn-primary btn-rounded btn-lg btn-shadow pull-right">
		</div>
	</div>
</form>