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
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="card">
			<div class="card-header">
				<div class="card-title"><?=BLOG?></div>
			</div>
			<div class="card_body">
				<form action="/blog/sendnew?management&page=true" method="post" class="form-horizontal">
					<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0"><?=NAME?></div>
					<div class="card-body">
						<input name="name" type="text" class="form-control" value="<?=$data->name?>">
					</div>
					<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0">Tags</div>
					<div class="card-body">
						<input name="tags" placeholder="( séparer par des => , )" value="<?=$tags?>" type="text" value="" data-role="tagsinput" class="form-control">
					</div>
					<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0"><?=TEXT?></div>
					<div class="form-group">
						<textarea class="ckeditor" name="content"><?=$data->content?></textarea>
					</div>
					<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0"><?=COMPLEMENT?></div>
					<div class="form-group">
						<textarea class="ckeditor2" name="additionalcontent"><?=$data->additionalcontent?></textarea>
					</div>
					<div class="card-footer">
						<input type="hidden" name="author" value="<?=$data->author?>">
						<input type="hidden" name="id" value="<?=$data->id?>">
						<button type="submit" class="btn btn-primary"><?=EDIT?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>