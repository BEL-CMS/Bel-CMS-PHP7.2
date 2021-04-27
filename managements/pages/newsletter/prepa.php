<?php
/**
 * Bel-CMS [Content management system]
 * @version 1.0.0
 * @link https://bel-cms.be
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2014-2019 Bel-CMS
 * @author as Stive - stive@determe.be
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