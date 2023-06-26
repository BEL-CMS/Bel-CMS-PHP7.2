<form action="Forum/SendEditPostPrimary" method="post" enctype="multipart/form-data">
	<div class="card">
		<div class="card-header"><h3><i class="fa fa-comment"></i> <?=EDIT_REPLY?></h3></div>
		<div class="card-body">
			<textarea class="bel_cms_textarea_simple" name="content"><?=$d->content?></textarea>
		</div>
		<div class="card-footer">
			<input type="hidden" name="id_threads" value="<?=$d->id_threads;?>">
			<input type="hidden" name="author" value="<?=$d->author;?>">
			<input type="submit" value="<?=EDIT_POST?>" class="btn btn-primary btn-rounded btn-lg btn-shadow pull-right">
		</div>
	</div>
</form>