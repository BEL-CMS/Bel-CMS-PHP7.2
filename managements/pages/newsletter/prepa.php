<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
?>
<form action="/newsletter/send?management&page=true" method="post" class="form-horizontal">
	<div class="col-md-12">
		<div class="panel panel-white">
			<div class="panel-body">
				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label"><?=NAME?></label>
					<div class="col-sm-10">
						<select required="required" name="id" class="form-control">
							<?php
							foreach ($data as $v):
								echo '<option value="'.$v->id.'">'.$v->id.' - '.$v->name.'</option>';
							endforeach;
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary"><?=ADD?></button>
				</div>
			</div>
		</div>
	</div>
</form>