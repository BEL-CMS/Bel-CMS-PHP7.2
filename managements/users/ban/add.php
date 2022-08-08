<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2022 Bel-CMS
 * @author Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
?>
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Bannissement</h3>
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
				<i class="fas fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="card-body">
		<div class="form-group">
			<form action="/ban/sendadd?management&users" method="post" class="form-horizontal form-bordered">
				<div class="form-group">
				<label class="col-sm-12 control-label" for="ban_author"><?=NAME?></label>
					<div class="col-sm-12">
						<select class="control-label" name="author" id="ban_author" required="required">
							<option>-- Choisir un utilisateur --</option>
							<?php
							foreach ($author as $k => $v):
								if ($_SESSION['USER']['HASH_KEY'] !== $v->hash_key):
							?>
							<option class="form-control" value="<?=$v->hash_key;?>"><?=$v->username;?></option>
							<?php
								endif;
							endforeach;
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-12 control-label" for="checkbox">Raison</label>
					<div class="col-sm-12">
						<textarea name="reason"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-12 control-label" for="checkbox"><?=DATE?></label>
					<div class="col-sm-12">
						<input type="datetime-local" name="date">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-12 control-label">Serial : administrateur - uniquement pour supprimé un compte admin de nv1</label>
					<div class="col-sm-12">
						<input type="number" max="32" name="gold" class="form-control">
					</div>
				</div>
				<div class="form-group form-actions">
					<div class="col-sm-12 col-sm-offset-3">
						<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=SAVE?></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>