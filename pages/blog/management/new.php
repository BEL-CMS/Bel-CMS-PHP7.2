<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.3.0
 * @link http://www.bel-cms.be
 * @link http://www.stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2016 Bel-CMS
 * @author Stive - mail@stive.eu
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
if (isset($_SESSION['LOGIN_MANAGEMENT']) && $_SESSION['LOGIN_MANAGEMENT'] === true):
?>
<div class="box-body">
	<a class="btn btn-app" href="Blog?management">
		<i class="fa fa-home"></i><?=BLOG?>
	</a>
	<a class="btn btn-app" href="Blog/NewBlog?management">
		<i class="fa fa-user-plus"></i><?=ADD?>
	</a>
	<a class="btn btn-app" href="Blog/Parameter?management">
		<i class="fa fa-cubes"></i><?=PARAMETER?>
	</a>
</div>

<form action="Blog/send?management" method="post">
	<div class="box">
		<div class="box-body">
			<div class="form-group">
				<label class="control-label" for="label_name"><?=NAME?> :</label>
				<div class="controls">
					<input name="name" type="text" class="form-control" id="label_name" placeholder="<?=NAME_OF_BLOG_PAGE?>" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label" for="label_tags"><?=TAGS?> :</label>
				<div class="controls">
					<input name="tags" type="text" class="form-control" id="label_tags" placeholder="Tags: séparer par des ,">
				</div>
			</div>
			<div class="form-group">
				<label><?=CONTENT?></label>
				<textarea class="bel_cms_textarea_simple" name="content" placeholder="Texte..."></textarea>
			</div>
			<div class="form-group">
				<label><?=ADDITIONAL_CONTENT?></label>
				<textarea class="bel_cms_textarea_simple" name="additionalcontent" placeholder="Texte..."></textarea>
			</div>
		</div>
		<div class="box-footer">
			<div class="card-footer">
				<input type="hidden" name="send" value="blog">
				<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i><?=ADD?></button>
			</div>
		</div>
	</div>
</form>
<?php
endif;
