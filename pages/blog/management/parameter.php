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

<form action="User/send?management" method="post">
	<div class="box">
		<div class="box-body">
			<div class="form-group">
				<label class="control-label" for="label_nb"><?=NB_BLOG?></label>
				<div class="controls">
					<input class="form-control" name="MAX_BLOG" type="number" id="label_nb" value="<?=$_SESSION['pages']->blog->config['MAX_BLOG']?>" min="1" max="16">
				</div>
			</div>
		</div>
		<div class="box-footer">
			<input type="hidden" name="send" value="parameter">
			<button type="submit" class="btn btn-primary"><?=SAVE?></button>
		</div>
	</div>
</form>
<?php
endif;
