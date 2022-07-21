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
$tags = null;
$c = count($data->tags);
foreach ($data->tags as $k => $v) {
	$v = str_replace(' ','',$v);
	if ($c != $k+1) {
		$tags.= $v. ', ';
	} else {
		$tags.= $v;
	}
}
?>
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Edition <?=BLOG?></h3>
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
				<i class="fas fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="card-body">
		<form action="/blog/sendedit?management&pages" method="post" class="form-horizontal form-bordered">
			<div class="form-group">
				<label class="col-sm-12 control-label" for="checkbox"><?=NAME?> :</label>
				<div class="col-sm-12">
					<input name="name" type="text" class="form-control" value="<?=$data->name?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label" for="checkbox">Tags :</label>
				<div class="col-sm-12">
					<input name="tags" placeholder="( séparer par des => , )" value="<?=$tags?>" type="text" value="" data-role="tagsinput" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label" for="checkbox"><?=TEXT?> :</label>
				<div class="col-sm-12">
					<textarea class="bel_cms_textarea_full" name="content"><?=$data->content?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12 control-label" for="checkbox">Lire la suite...</label>
				<div class="col-sm-12">
					<textarea class="bel_cms_textarea_full" name="additionalcontent"><?=$data->additionalcontent?></textarea>
				</div>
			</div>
			<div class="form-group form-actions">
				<div class="col-sm-12 col-sm-offset-3">
					<input type="hidden" name="author" value="<?=$data->author?>">
					<input type="hidden" name="id" value="<?=$data->id?>">
					<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=SAVE?></button>
				</div>
			</div>
		</form>
	</div>
</div>
<?php
endif;