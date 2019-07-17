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
if (isset($_SESSION['LOGIN_MANAGEMENT']) && $_SESSION['LOGIN_MANAGEMENT'] === true):
?>
<div class="col-md-12">
	<div class="panel panel-white">
		<div class="panel-heading clearfix">
			<h4 class="panel-title"><?=BLOG?></h4>
		</div>
		<div class="panel-body basic-form-panel">
			<form action="/blog/sendnew?management&page=true" method="post" class="form-horizontal">
				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label"><?=NAME?></label>
					<div class="col-sm-10">
						<input name="name" type="text" class="form-control" id="input-Default" value="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Tags</label>
					<div class="col-sm-10">
						<input name="tags" type="text" value="" data-role="tagsinput" class="form-control">
						<p class="help-block">(séparer par des ",")</p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?=TEXT?></label>
					<div class="col-sm-10">
						<textarea class="bel_cms_textarea_full" name="content"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?=COMPLEMENT?></label>
					<div class="col-sm-10">
						<textarea class="bel_cms_textarea_full" name="additionalcontent"></textarea>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary"><?=ADD?></button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
endif;