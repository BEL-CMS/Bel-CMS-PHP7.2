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
if ($data['status'] == 'open') {
	$ckd = 'checked="checked"';
} else {
	$ckd = '';
}
?>

<form action="/maintenance/sendpostOpen?management&parameter=true" enctype="multipart/form-data" method="post" class="form-horizontal form-label-left">
	<div class="card card-info">
		<div class="card-header">
			<h3 class="card-title">Maintenance : Statut du site</h3>
		</div>
		<div class="card-body">
			<label class="custom-switch">
				<input value="open" type="checkbox" name="close" class="custom-switch-input" <?=$ckd?>>
				<span class="custom-switch-indicator"></span>
				<span class="custom-switch-description">Ouvert</span>
			</label>
		</div>
		<div class="card-footer" style="margin-top: -15px;">
			<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=SEND?></button>
		</div>
	</div>
</form>

<form action="/maintenance/sendpost?management&parameter=true" enctype="multipart/form-data" method="post" class="form-horizontal form-label-left">
	<div class="card card-secondary">
		<div class="card-header">
			<h3 class="card-title">Message de fermeture</h3>
		</div>
		<div class="form-group">
			<label class="control-label col-md-12">Titre</label>
			<div class="col-md-12">
				<input type="text" name="title" class="form-control" value="<?=$data['title']?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-12">Description</label>
			<div class="col-md-12">
				<textarea name="description" class="form-control" rows="3" placeholder=''><?=$data['description']?></textarea>
			</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary mb-5"><?=SEND?></button>
		</div>
	</div>
</form>