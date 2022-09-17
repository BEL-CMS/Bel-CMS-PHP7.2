	<h2>Liens Social</h2>
	<form action="user/submitsocial" method="post">
		<div class="form-group row">
			<label class="col-sm-12 col-form-label"><i class="fab fa-facebook-square"></i> Facebook</label>
			<div class="col-sm-12">
				<input class="form-control" name="facebook" type="text" placeholder="<?=constant('ENTER_YOUR');?> facebook" value="<?=$user->facebook?>" pattern="^[a-z\d\.]{5,}$">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-12 col-form-label"><i class="fab fa-twitter-square"></i> Twitter</label>
			<div class="col-sm-12">
				<input class="form-control" name="twitter" type="text" placeholder="<?=constant('ENTER_YOUR');?> twitter" value="<?=$user->twitter?>" pattern="^[A-Za-z0-9_]{1,15}$">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-12 col-form-label"><i class="fab fa-discord"></i> Discord</label>
			<div class="col-sm-12">
				<input class="form-control" name="discord" type="text" placeholder="<?=constant('ENTER_YOUR');?> Discord" value="<?=$user->discord?>">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-12 col-form-label"><i class="fab fa-pinterest-square"></i> Pinterest</label>
			<div class="col-sm-12">
				<input class="form-control" name="pinterest" type="text" placeholder="<?=constant('ENTER_YOUR');?> pinterest" value="<?=$user->pinterest?>">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-12 col-form-label"><i class="fab fa-linkedin"></i> Linkedin</label>
			<div class="col-sm-12">
				<input class="form-control" name="linkedin" type="text" placeholder="<?=constant('ENTER_YOUR');?> linkedin" value="<?=$user->linkedin?>">
			</div>
		</div>
		<hr>

		<button type="submit" class="btn btn-primary">Enregistrer</button>

	</form>