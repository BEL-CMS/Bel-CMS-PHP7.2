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
				<label><?=NAME?></label>
				<input name="name" class="form-control" type="text"  placeholder="<?=NAME_OF_BLOG_PAGE?>" required="required" value="<?=$data->name?>">
			</div>
			<div class="form-group">
				<label><?=TAGS?></label>
				<input name="tags" type="text" class="form-control" placeholder="Tags: séparer par des ,", value="<?=implode(',', $data->tags)?>">
			</div>
			<div class="form-group">
				<label><?=CONTENT?></label>
				<textarea class="bel_cms_textarea_simple" name="content" placeholder="Texte...">
					<?=$data->content?>
				</textarea>
			</div>
			<div class="form-group">
				<label><?=ADDITIONAL_CONTENT?></label>
				<textarea class="bel_cms_textarea_simple" name="additionalcontent" placeholder="Texte...">
					<?=$data->additionalcontent?>
				</textarea>
			</div>
		</div>
		<div class="box-footer">
			<input type="hidden" name="send" value="edit">
			<input type="hidden" name="id" value="<?=$data->id?>">
			<input type="hidden" name="authoredit" value="<?=$_SESSION['user']->hash_key?>">
			<input type="hidden" name="author" value="<?=$data->author->hash_key?>">
			<input class="btn btn-primary" type="submit" value="<?=EDIT?>">
		</div>
	</div>
</form>
<?php
endif;
