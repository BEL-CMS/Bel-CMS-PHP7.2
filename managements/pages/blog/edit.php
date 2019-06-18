<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
 * @link https://bel-cms.be
 * @link https://stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2019 Bel-CMS
 * @author Stive - determe@stive.eu
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
<div class="col-md-12">
	<div class="panel panel-white">
		<div class="panel-heading clearfix">
			<h4 class="panel-title"><?=BLOG?></h4>
		</div>
		<div class="panel-body basic-form-panel">
			<form action="/blog/sendedit?management&page=true" method="post" class="form-horizontal">
				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label"><?=NAME?></label>
					<div class="col-sm-10">
						<input name="name" type="text" class="form-control" id="input-Default" value="<?=$data->name?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Tags</label>
					<div class="col-sm-10">
						<input name="tags" type="text" value="<?=$tags?>" data-role="tagsinput" class="form-control">
						<p class="help-block">(séparer par des ",")</p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?=TEXT?></label>
					<div class="col-sm-10">
						<textarea class="bel_cms_textarea_full" name="content">
							<?=$data->content?>
						</textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?=COMPLEMENT?></label>
					<div class="col-sm-10">
						<textarea class="bel_cms_textarea_full" name="additionalcontent">
							<?=$data->additionalcontent?>
						</textarea>
					</div>
				</div>
				<div class="form-group">
					<input type="hidden" name="author" value="<?=$data->author?>">
					<input type="hidden" name="id" value="<?=$data->id?>">
					<button type="submit" class="btn btn-primary"><?=EDIT?></button>
				</div>
			</form>
		</div>
	</div>
</div>