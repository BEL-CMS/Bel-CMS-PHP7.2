<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
        <div class="block">
            <div class="block-title">
                <h2>Edition du message</h2>
            </div>
			<form action="/Forum/sendeditMessage?management&page=true" method="post" class="form-horizontal form-bordered">
				<div class="form-group">
					<label class="col-sm-3 control-label" for="checkbox">Contenue</label>
					<div class="col-sm-9">
						<textarea class="bel_cms_textarea_simple" name="info_text"><?=$data->content;?></textarea>
					</div>
				</div>
				<div class="form-group">
					<input type="hidden" name="id" value="<?=$data->id;?>">
					<input type="submit" value="Editer ce post" class="btn btn-primary btn-rounded btn-lg btn-shadow pull-right">
				</div>
			</form>
		</div>
	</div>
</div>