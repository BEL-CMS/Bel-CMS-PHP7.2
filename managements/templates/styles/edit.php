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
<form action="/styles/send?management&templates" method="post">
	<div class="card">
		<div class="card-header">
			Styles
		</div>
		<div class="card-body">
			<div class="form-group">
				<label class="col-sm-12 control-label" for="checkbox"><?=TEXT?></label>
					<textarea rows="15" cols="35" name="content" style="width: 100%;">
						<?php
						echo $data;
						?>
					</textarea>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<input type="hidden" name="page" value="<?=$page;?>">
			<button type="submit" class="btn btn-primary"><?=SUBMIT?></button>
		</div>
	</div>
</form>