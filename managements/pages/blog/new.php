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
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
        <div class="block">
            <div class="block-title">
                <h2>Nouveau <?=BLOG?></h2>
            </div>
			<form action="/blog/sendnew?management&page=true" method="post" class="form-horizontal form-bordered">
				<div class="form-group">
					<label class="col-sm-3 control-label" for="checkbox"><?=NAME?></label>
					<div class="col-sm-9">
						<input name="name" type="text" class="form-control" value="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="checkbox">Tags</label>
					<div class="col-sm-9">
						<input name="tags" placeholder="( séparer par des => , )" type="text" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="checkbox"><?=TEXT?></label>
					<div class="col-sm-9">
						<textarea class="bel_cms_textarea_full" name="content"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="checkbox"><?=COMPLEMENT?></label>
					<div class="col-sm-9">
						<textarea class="bel_cms_textarea_full" name="additionalcontent"></textarea>
					</div>
				</div>
				<div class="form-group form-actions">
					<div class="col-sm-9 col-sm-offset-3">
						<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=SAVE?></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
endif;