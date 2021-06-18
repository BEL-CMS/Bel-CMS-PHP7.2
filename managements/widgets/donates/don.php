<?php
/**
 * Bel-CMS [Content management system]
 * @version 1.0.0
 * @link https://bel-cms.be
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2014-2021 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
?>
	<div class="col-lg-6 col-md-6 col-sm-6">
		<div class="block">
			<div class="block-title">
				<h2>Ajouter un donateur</h2>
			</div>
			<form action="/donates/senddon?management&widgets=true" method="post" class="form-horizontal form-bordered">
				<div class="form-group">
					<label class="col-sm-2 control-label">Nom du donateur</label>
					<div class="col-sm-10">
						<select name="hash_key" required class="form-control">
							<option value="00000000000000000000000000000000">Anonyme</option>
						<?php
						foreach ($users as $key => $value) {
							?>
							<option value="<?=$value->hash_key;?>"><?=$value->username;?></option>
							<?php
						}
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Date</label>
					<div class="col-sm-10">
						<input type="date" id="last-name" name="date" class="form-control col-md-7 col-xs-12" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Montant</label>
					<div class="col-sm-10">
						<div class="checkbox">
							<input class="form-control" name="euros" type="number" value="" placeholder="en euros" min="1" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						<button type="submit" class="btn btn-success">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>